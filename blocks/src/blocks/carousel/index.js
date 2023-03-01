import React from "react";
import {registerBlockType} from '@wordpress/blocks';
import edit from "./edit";
import save from "./save";

registerBlockType("ln-blocks/carousel", {
	title: "Carousel",
	description: "Simple Carousel",
	category: "common",
	icon: "format-image",
	supports: {
		html: false,
	},
	attributes: {
		items: {
			type: "array",
			default: [
				{
					id: 1,
					title: "Заголовок первого слайда",
					subtitle: "Подзаголовок первого слайда",
					img: {
						src: "http://placehold.it/200"
					}
				}
			]
		}
	},
	edit,
	save
});
