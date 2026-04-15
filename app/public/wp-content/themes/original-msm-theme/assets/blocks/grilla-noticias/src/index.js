import { registerBlockType } from '@wordpress/blocks';
import Edit from './edit';

registerBlockType('msm-theme/grilla-noticias', {
    edit: Edit,
    // Dynamic blocks don't need a save function in JS, or it can return null
    save: () => null,
});
