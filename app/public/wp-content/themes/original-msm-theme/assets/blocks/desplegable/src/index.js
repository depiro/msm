import { registerBlockType } from '@wordpress/blocks';
import Edit from './edit';
import Save from './save';
import './style.scss'; // Importing mainly for build process, though we avoid new styles if possible, standard pattern.

// Actually user said NO CSS. So I will ensure this file is empty or not used.
// We will rely on inline styles in Edit and Save components.

registerBlockType('msm-theme/desplegable', {
    edit: Edit,
    save: Save,
});
