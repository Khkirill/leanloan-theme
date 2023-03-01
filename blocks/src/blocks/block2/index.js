import { registerBlockType } from '@wordpress/blocks';
import { __ } from '@wordpress/i18n';
import './style.scss';
import './editor.scss';

registerBlockType( 'create-block/gutenpride2', {
	title: __( 'Gutenpride2', 'gutenpride2' ),
	description: __(
		'Example block written with ESNext standard and JSX support – build step required.',
		'gutenpride2'
	),
	category: 'widgets',
	icon: 'smiley',
	supports: {
		html: false,
	},
	edit: () => {
		return (
			<div>edit2</div>
		);
	},
	save: () => {
		return (
			<div>save2</div>
		);
	}
} );
