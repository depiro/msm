import { __ } from '@wordpress/i18n';
import { useBlockProps, RichText, InnerBlocks } from '@wordpress/block-editor';

export default function Edit({ attributes, setAttributes }) {
    const { title } = attributes;

    const BLOCK_TEMPLATE = [
        ['core/details', {}, [
            ['core/paragraph', { placeholder: 'Contenido del desplegable...' }]
        ]]
    ];

    return (
        <div {...useBlockProps({ className: 'wp-block-group' })}>
            {/* 
               The .wp-block-group > p:first-child CSS selector in style.css triggers the 
               blue gradient background and the ::before pseudo-element (arrow).
            */}
            <RichText
                tagName="p"
                value={title}
                onChange={(val) => setAttributes({ title: val })}
                placeholder={__('Escribí el título de la sección...')}
                allowedFormats={[]} // Plain text
            />

            <div className="msm-desplegable-content">
                <InnerBlocks
                    template={BLOCK_TEMPLATE}
                    allowedBlocks={['core/details']}
                />
            </div>
        </div>
    );
}
