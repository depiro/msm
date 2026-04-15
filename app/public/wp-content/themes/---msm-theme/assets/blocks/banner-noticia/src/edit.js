import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, SelectControl, ComboboxControl, Spinner, Placeholder } from '@wordpress/components';
import { useSelect } from '@wordpress/data';
import { useState } from '@wordpress/element';

export default function Edit({ attributes, setAttributes }) {
    const { postId, width, align } = attributes;

    const [search, setSearch] = useState('');

    // 1. Fetch posts for the Combobox search
    const { posts, isResolvingPosts } = useSelect((select) => {
        const query = {
            per_page: 20,
            status: 'publish',
            search: search,
        };
        return {
            posts: select('core').getEntityRecords('postType', 'noticias-banner', query),
            isResolvingPosts: select('core').isResolving('getEntityRecords', ['postType', 'noticias-banner', query]),
        };
    }, [search]);

    const options = posts ? posts.map((post) => ({
        value: post.id,
        label: `${post.title.rendered} (ID: ${post.id})`,
    })) : [];

    // 2. Fetch the selected Post
    const selectedPost = useSelect((select) => {
        return postId ? select('core').getEntityRecord('postType', 'noticias-banner', postId) : null;
    }, [postId]);

    // 3. Fetch Featured Image
    const featuredMediaId = selectedPost?.featured_media;
    const featuredMedia = useSelect((select) => {
        return featuredMediaId ? select('core').getMedia(featuredMediaId) : null;
    }, [featuredMediaId]);

    // 4. Fetch Tags
    const tagIds = selectedPost?.tags || [];
    // Memoize the JSON string to avoid infinite re-renders if array reference changes
    const tagIdsString = JSON.stringify(tagIds);
    const postTags = useSelect((select) => {
        return (tagIds.length > 0)
            ? select('core').getEntityRecords('taxonomy', 'post_tag', { include: tagIds })
            : [];
    }, [tagIdsString]);


    // Handlers
    const onSelectPost = (value) => {
        setAttributes({ postId: parseInt(value) });
    };

    // Helper to strip HTML and trim
    const getExcerpt = (post) => {
        if (!post) return '';
        let text = post.excerpt?.rendered || post.content?.rendered || '';
        // Create a temporary element to strip HTML
        const tmp = document.createElement('DIV');
        tmp.innerHTML = text;
        text = tmp.textContent || tmp.innerText || '';
        // Trim words (approximate)
        const words = text.split(' ');
        if (words.length > 20) {
            return words.slice(0, 20).join(' ') + '...';
        }
        return text;
    };


    // --- Render Logic for Preview ---

    // Classes based on attributes (Mirroring PHP Logic)
    // $col_class = ($width === 'half') ? 'col-12 col-md-6' : 'col-12';
    // But in the editor, we might just want to show the card itself, or simulate the column.
    // Since block editor usually handles width via alignment support, we'll try to visually mimic the card.

    const imageUrl = featuredMedia?.source_url || '';
    const title = selectedPost?.title?.rendered || __('Sin título', 'msm-theme');
    const desc = getExcerpt(selectedPost);

    // Preview Styles
    const bgStyle = {
        backgroundImage: imageUrl ? `url('${imageUrl}')` : 'none',
        backgroundColor: '#eee', // fallback
        backgroundSize: 'cover',
        backgroundPosition: 'center',
    };

    // Position styles based on align
    // if ($align === 'right') -> Image Left:0, Right:32px.
    const bgPositionStyle = (align === 'right')
        ? { left: 0, right: '32px' }
        : { left: '32px', right: 0 };

    const justifyClass = (align === 'right') ? 'justify-content-end' : 'justify-content-start';

    return (
        <div {...useBlockProps()}>
            <InspectorControls>
                <PanelBody title={__('Configuración de Noticia', 'msm-theme')}>
                    <ComboboxControl
                        label={__('Buscar Noticia', 'msm-theme')}
                        value={postId}
                        options={options}
                        onFilterValueChange={setSearch}
                        onChange={onSelectPost}
                        help={__('Escribí para buscar por título.', 'msm-theme')}
                        isLoading={isResolvingPosts}
                    />

                    <SelectControl
                        label={__('Ancho', 'msm-theme')}
                        value={width}
                        options={[
                            { label: 'Ancho Completo (Full)', value: 'full' },
                            { label: 'Medio Ancho (Half)', value: 'half' },
                        ]}
                        onChange={(value) => setAttributes({ width: value })}
                    />

                    <SelectControl
                        label={__('Alineación', 'msm-theme')}
                        value={align}
                        options={[
                            { label: 'Izquierda', value: 'left' },
                            { label: 'Derecha', value: 'right' },
                        ]}
                        onChange={(value) => setAttributes({ align: value })}
                    />
                </PanelBody>
            </InspectorControls>

            {postId ? (
                selectedPost ? (
                    <div className="msm-block-preview" style={{ padding: '20px', border: '1px dotted #e2e4e7' }}>
                        {/* Card Overlay Structure */}
                        <div className="card-overlay-wrapper position-relative" style={{ minHeight: '400px', display: 'flex', alignItems: 'center' }}>

                            {/* Background Layer */}
                            <div className="position-absolute top-0 bottom-0 rounded shadow-sm overflow-hidden"
                                style={{
                                    ...bgStyle,
                                    ...bgPositionStyle,
                                    zIndex: 0,
                                    position: 'absolute',
                                    top: 0, bottom: 0
                                }}
                            ></div>

                            {/* Content Layer */}
                            <div className={`container-fluid position-relative d-flex ${justifyClass} px-0`} style={{ zIndex: 1, width: '100%', pointerEvents: 'none' }}>
                                <div className="overlay-box bg-white p-4 rounded shadow-sm" style={{ maxWidth: '450px', width: '100%' }}>

                                    <h3 className="fw-bold mb-3"
                                        style={{ color: 'var(--bs-body-color)' }}
                                        dangerouslySetInnerHTML={{ __html: title }}
                                    />

                                    <p className="mb-3 text-secondary">
                                        {desc}
                                    </p>

                                    {postTags && postTags.length > 0 && (
                                        <div className="tags-container mb-0">
                                            {postTags.map(tag => (
                                                <span key={tag.id} className="badge bg-light text-primary me-2 mb-2 fw-normal text-uppercase" style={{ fontSize: '0.7rem' }}>
                                                    {tag.name}
                                                </span>
                                            ))}
                                        </div>
                                    )}

                                </div>
                            </div>

                        </div>
                    </div>
                ) : (
                    <div className="components-placeholder is-large">
                        <Spinner />
                        <span style={{ marginLeft: '10px' }}>{__('Cargando noticia...', 'msm-theme')}</span>
                    </div>
                )
            ) : (
                <Placeholder
                    icon="megaphone"
                    label={__('Banner de Noticia', 'msm-theme')}
                    instructions={__('Por favor, seleccioná una noticia en el panel lateral para mostrarla.', 'msm-theme')}
                />
            )}
        </div>
    );
}
