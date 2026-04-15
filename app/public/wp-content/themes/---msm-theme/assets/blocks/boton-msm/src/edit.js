import { __ } from '@wordpress/i18n';
import { useBlockProps, RichText, InspectorControls, URLInput } from '@wordpress/block-editor';
import { PanelBody, SelectControl, ToggleControl, TextControl } from '@wordpress/components';

export default function Edit({ attributes, setAttributes }) {
    const { text, url, variant, linkTarget } = attributes;

    const onChangeText = (newText) => setAttributes({ text: newText });
    const onChangeUrl = (newUrl) => setAttributes({ url: newUrl });
    const onChangeVariant = (newVariant) => setAttributes({ variant: newVariant });
    const onChangeTarget = (newTarget) => setAttributes({ linkTarget: newTarget ? '_blank' : '_self' });

    const wrapperProps = useBlockProps();

    return (
        <div {...wrapperProps}>
            <InspectorControls>
                <PanelBody title={__('Configuración del Botón')}>
                    <TextControl
                        label={__('URL del enlace')}
                        value={url}
                        onChange={onChangeUrl}
                    />
                    <ToggleControl
                        label={__('Abrir en nueva pestaña')}
                        checked={linkTarget === '_blank'}
                        onChange={onChangeTarget}
                    />
                    <SelectControl
                        label={__('Variante')}
                        value={variant}
                        options={[
                            { label: 'Sólido (Cyan)', value: 'solid' },
                            { label: 'Gradiente (Azul)', value: 'gradient' },
                        ]}
                        onChange={onChangeVariant}
                    />
                </PanelBody>
            </InspectorControls>

            {/* Visual Preview */}
            <div className="mb-3">
                <a
                    className={`btn-msm-cta btn-msm-${variant}`}
                    href="#" // Prevent clicking in editor
                    onClick={(e) => e.preventDefault()}
                    role="button"
                >
                    <RichText
                        tagName="span"
                        value={text}
                        onChange={onChangeText}
                        placeholder={__('Texto del botón...')}
                        allowedFormats={[]}
                    />
                    <span className="icon-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" className="msm-icon-arrow">
                            <path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6-6-6z" />
                        </svg>
                    </span>
                </a>
            </div>
        </div>
    );
}
