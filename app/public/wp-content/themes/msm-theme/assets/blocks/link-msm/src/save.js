import { useBlockProps, RichText } from '@wordpress/block-editor';

export default function Save({ attributes }) {
    const { text, url, variant, linkTarget } = attributes;

    const blockProps = useBlockProps.save();

    return (
        <div {...blockProps}>
            <div className="mb-3">
                <a
                    href={url}
                    className={`btn-msm-link btn-msm-link-${variant}`}
                    target={linkTarget}
                    rel={linkTarget === '_blank' ? 'noopener noreferrer' : undefined}
                >
                    <RichText.Content tagName="span" value={text} />
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" className="msm-icon-arrow">
                        <path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6-6-6z" />
                    </svg>
                </a>
            </div>
        </div>
    );
}
