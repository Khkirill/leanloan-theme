import "./scss/editor.scss";
import "./scss/style.scss";
import {registerBlockType} from '@wordpress/blocks';
import {useBlockProps, InnerBlocks} from '@wordpress/block-editor';

registerBlockType('ln-blocks/container', {
	title: "Контейнер",
	description: "Simple container",
	category: "layout",
	icon: "archive",
	supports: {
		html: false,
	},
	edit: ({isSelected}) => {
		const blockProps = useBlockProps({ className: "container" });
		return (
			<div {...blockProps}>
				<InnerBlocks/>
			</div>
		);
	},
	save: () => {
		const blockProps = useBlockProps.save();
		return (
			<div className="container">
				<InnerBlocks.Content/>
			</div>
		);
	}
});
