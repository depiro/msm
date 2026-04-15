import { registerBlockType } from '@wordpress/blocks';
import Edit from './edit';
import Save from './save';
import './style.scss';

registerBlockType('msm-theme/link-msm', {
    edit: Edit,
    save: Save,
});
