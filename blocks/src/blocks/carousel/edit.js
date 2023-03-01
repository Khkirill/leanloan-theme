import React from "react";
import {useBlockProps} from '@wordpress/block-editor';
import Inspector from "./inspector";
import ReactSiema from "react-siema";
import './scss/editor.scss';
import Slide from "./slide";

const {Button} = wp.components;


export default function edit({attributes, setAttributes}) {
	const blockProps = useBlockProps({className:"carousel-block"});
	let slider = null;
	const setValue = (nextValue, id) => setAttributes({
		items: attributes.items.map(
			item => item.id === parseInt(id) ? {...item, title: nextValue} : item
		)
	});
	const addItem = () => {
		setAttributes({
			items: [...attributes.items, {
				id: attributes.items.length + 1,
				title: "Заголовок нового слайда " + (attributes.items.length + 1).toString(),
				subtitle: "Подзаголовок нового слайда " + (attributes.items.length + 1).toString(),
				img: {
					src: "http://placehold.it/200"
				}
			}]
		})
	}

	const onSortEnd = (items) => {
		setAttributes({items: items})
	}

	const openSidebar = (event) => {
		event.preventDefault();
		const isSidebarOpened = wp.data.select('core/edit-post').isEditorSidebarOpened();
		if (!isSidebarOpened) {
			wp.data.dispatch('core/edit-post').openGeneralSidebar("edit-post/block");
		}
	};

	const prev = () => {
		slider.prev()
	}
	const next = () => {
		slider.next()
	}

	return (
		<div {...blockProps}>
			<Inspector items={attributes.items} setAttributes={setAttributes} addItem={addItem} onSortEnd={onSortEnd}
					   openSidebar={openSidebar}/>
			<ReactSiema ref={obj => slider = obj}>
				{attributes.items.map(item => <div key={item.id}><Slide item={item}/></div>)}
			</ReactSiema>
			<div className="carousel-controls">
				<button onClick={prev} type="button" className="carousel-control carousel-control_side_left">
					<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
						 width="284.935px" height="284.936px" viewBox="0 0 284.935 284.936">
						<path fill="#5e5e5e" d="M222.701,135.9L89.652,2.857C87.748,0.955,85.557,0,83.084,0c-2.474,0-4.664,0.955-6.567,2.857L62.244,17.133
				c-1.906,1.903-2.855,4.089-2.855,6.567c0,2.478,0.949,4.664,2.855,6.567l112.204,112.204L62.244,254.677
				c-1.906,1.903-2.855,4.093-2.855,6.564c0,2.477,0.949,4.667,2.855,6.57l14.274,14.271c1.903,1.905,4.093,2.854,6.567,2.854
				c2.473,0,4.663-0.951,6.567-2.854l133.042-133.044c1.902-1.902,2.854-4.093,2.854-6.567S224.603,137.807,222.701,135.9z"/>
					</svg>
				</button>
				<button onClick={next} type="button" className="carousel-control">
					<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
						 width="284.935px" height="284.936px" viewBox="0 0 284.935 284.936">
						<path fill="#5e5e5e" d="M222.701,135.9L89.652,2.857C87.748,0.955,85.557,0,83.084,0c-2.474,0-4.664,0.955-6.567,2.857L62.244,17.133
				c-1.906,1.903-2.855,4.089-2.855,6.567c0,2.478,0.949,4.664,2.855,6.567l112.204,112.204L62.244,254.677
				c-1.906,1.903-2.855,4.093-2.855,6.564c0,2.477,0.949,4.667,2.855,6.57l14.274,14.271c1.903,1.905,4.093,2.854,6.567,2.854
				c2.473,0,4.663-0.951,6.567-2.854l133.042-133.044c1.902-1.902,2.854-4.093,2.854-6.567S224.603,137.807,222.701,135.9z"/>
					</svg>
				</button>
			</div>
		</div>
	);
}
