import { registerBlockType } from '@wordpress/blocks';
import Edit from './edit';
import Save from './save';
import './style.scss';

registerBlockType('msm-theme/boton-msm', {
    edit: Edit,
    save: Save,
});
