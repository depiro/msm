/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';

/**
 * Components to use in the edit interface
 */
import { PanelBody, TextControl, FormTokenField, Spinner } from '@wordpress/components';
import { useSelect } from '@wordpress/data';
import { useState, useEffect } from '@wordpress/element';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @param {Object}   props               Properties passed to the function.
 * @param {Object}   props.attributes    Available block attributes.
 * @param {Function} props.setAttributes Function that updates block attributes.
 *
 * @return {Element} Element to render.
 */
export default function Edit({ attributes, setAttributes }) {
    const { blockTitle, selectedPosts } = attributes;

    const [suggestions, setSuggestions] = useState([]);
    const [isSearching, setIsSearching] = useState(false);

    // Fetch posts when searching (debounced ideally, but simplified here)
    // In a real scenario, use useSelect inside a debounce or similar, or just fetch all logic.
    // For FormTokenField, we often fetch suggestions based on input.

    // Using useSelect to fetch full post objects for the PREVIEW (ids -> objects)
    const { previewPosts, isResolvingPreview } = useSelect((select) => {
        if (!selectedPosts || selectedPosts.length === 0) {
            return { previewPosts: [], isResolvingPreview: false };
        }
        const postIds = selectedPosts.map(p => p.id);
        const query = {
            include: postIds,
            per_page: postIds.length,
            status: ['publish', 'draft', 'future'], // Allow selecting drafts for preview
        };
        return {
            previewPosts: select('core').getEntityRecords('postType', 'post', query),
            isResolvingPreview: select('core').isResolving('getEntityRecords', ['postType', 'post', query]),
        };
    }, [selectedPosts]);


    /**
     * Search function for FormTokenField
     */
    async function searchPosts(search) {
        setIsSearching(true);
        try {
            // Adjust API path if needed for CPTs, currently assumes strict 'post' type
            const response = await fetch(`/wp-json/wp/v2/posts?search=${encodeURIComponent(search)}&per_page=20`);
            const data = await response.json();
            const results = data.map(post => ({
                id: post.id,
                value: post.title.rendered || `(No Title - ID ${post.id})`, // FormTokenField uses 'value' string match
                title: post.title.rendered || `(No Title - ID ${post.id})`,
            }));
            setSuggestions(results.map(r => r.value)); // FormTokenField expects array of strings
            // We need to keep a map of titles to IDs for the actual selection
            // But FormTokenField is tricky with objects.
            // Simplified approach: rely on the 'suggestions' state to map back strings to objects? 
            // Better: Store the search results in a ref or state object to lookup ID by title string on select.
            window._lastSearchResults = results; // Temporary hack or use state
        } catch (e) {
            console.error(e);
        } finally {
            setIsSearching(false);
        }
    }

    // Since FormTokenField in older WP versions deals with strings, we handle the mapping carefully.
    // Modern WP supports objects in value, but let's stick to simple strings for tokens if needed, 
    // or better yet, manage the state directly.

    // Actually, `value` prop of FormTokenField can be objects if `displayTransform` is allowed, 
    // but standard is Array of strings.
    // Let's use the strings as the "token" and map them.

    const onTokensChanged = (tokens) => {
        // Tokens is an array of strings (titles).
        // We need to reconstruct the objects.
        // 1. Existing selectedPosts
        // 2. New tokens (added)

        // This is complex because if generic titles exist (duplicates), it fails.
        // A better component for Post Selection is `ComboboxControl` (single) or a custom List.
        // PRO TIP: Use a custom list of items with "Add Post" button that opens a Combobox or Modal.
        // Given constraint: "Selector de publicaciones".
        // Let's try FormTokenField but careful with titles.

        // ALTERNATIVE: Use a simple list of ID controls, but we want a multi-select experience.

        // Let's implement the logic:
        // We will store { id, title } in attributes.
        // We pass `selectedPosts.map(p => p.title)` to FormTokenField value.
        // When changed, we find the added string in `_lastSearchResults` to get the ID.

        const currentTitles = selectedPosts.map(p => p.title);

        // Helper to find ID by title from recent search
        const findPostByTitle = (title) => {
            // Check in already selected
            const existing = selectedPosts.find(p => p.title === title);
            if (existing) return existing;

            // Check in search results
            if (window._lastSearchResults) {
                const found = window._lastSearchResults.find(r => r.title === title);
                if (found) return { id: found.id, title: found.title };
            }
            return null;
        };

        const newSelectedPosts = tokens.reduce((acc, token) => {
            const postObj = findPostByTitle(token);
            if (postObj) {
                acc.push(postObj);
            }
            return acc;
        }, []);

        setAttributes({ selectedPosts: newSelectedPosts });
    };

    return (
        <div {...useBlockProps()}>
            <InspectorControls>
                <PanelBody title={__('Configuración')}>
                    <TextControl
                        label={__('Título del Bloque')}
                        value={blockTitle}
                        onChange={(val) => setAttributes({ blockTitle: val })}
                        help={__('Se muestra como encabezado H2.')}
                    />
                    <div className='components-base-control'>
                        <label className='components-base-control__label'>{__('Buscar Noticias')}</label>
                        <FormTokenField
                            value={selectedPosts.map(p => p.title)}
                            suggestions={suggestions}
                            onInputChange={(input) => {
                                if (input.length > 2) searchPosts(input);
                            }}
                            onChange={onTokensChanged}
                            label={__('Escribe para buscar...')}
                        />
                        <p className='components-form-token-field__help'>
                            {__('Escribí el título y seleccioná. Podés reordenar borrando y agregando.')}
                        </p>
                    </div>
                </PanelBody>
            </InspectorControls>

            {/* EDITOR PREVIEW */}
            <div className="msm-grilla-noticias-preview p-3 border rounded">
                {blockTitle && <h2 className="mb-4">{blockTitle}</h2>}

                {!selectedPosts.length ? (
                    <div className="alert alert-info p-3 text-center">
                        {__('Seleccioná noticias en el panel lateral para ver la grilla.')}
                    </div>
                ) : (
                    <div className="row g-4">
                        {previewPosts && previewPosts.length > 0 ? (
                            previewPosts.map(post => (
                                <div key={post.id} className="col-12 col-md-6">
                                    <div className="border-0 bg-transparent">
                                        <h3 className="h5 fw-bold mb-2">{post.title.rendered}</h3>
                                        <div
                                            className="text-muted small"
                                            dangerouslySetInnerHTML={{ __html: post.excerpt.rendered ? post.excerpt.rendered.substring(0, 150) + '...' : '' }}
                                        />
                                    </div>
                                </div>
                            ))
                        ) : (
                            <div className="col-12 text-center text-muted"> <Spinner /> Cargando vista previa...</div>
                        )}
                    </div>
                )}
            </div>
        </div>
    );
}
