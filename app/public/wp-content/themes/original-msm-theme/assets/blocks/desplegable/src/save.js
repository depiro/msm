import { useBlockProps, RichText, InnerBlocks } from '@wordpress/block-editor';

export default function Save({ attributes }) {
    const { title } = attributes;

    return (
        <div {...useBlockProps.save({ className: 'wp-block-group' })}>
            <RichText.Content tagName="p" value={title} />

            <div className="msm-desplegable-content">
                <InnerBlocks.Content />
            </div>
        </div>
    );
}
