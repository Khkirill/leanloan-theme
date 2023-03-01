import React from "react";
import Sortable from "gutenberg-sortable";
import {InspectorControls} from '@wordpress/block-editor';
import {MediaUpload, MediaUploadCheck} from '@wordpress/block-editor';
import {ReactSortable} from "react-sortablejs";

const {PanelBody, TextControl, TextareaControl, Button} = wp.components;

export default function Inspector({items, setAttributes, onSortEnd, addItem, openSidebar}) {
	const changeImg = (media, id) => {
		setAttributes({
			items: items.map(item => {
				if (item.id === id) {
					item.img.src = media.url;
				}
				return item;
			})
		});
	}
	const changeTitle = (title, id) => {
		setAttributes({
			items: items.map(item => {
				if (item.id === id) {
					item.title = title;
				}
				return item;
			})
		});
	}
	const changeSubtitle = (subtitle, id) => {
		setAttributes({
			items: items.map(item => {
				if (item.id === id) {
					item.subtitle = subtitle;
				}
				return item;
			})
		});
	}

	return (
		<>
			<Button
				className="ln-button-edit"
				onClick={openSidebar} icon="edit" label="Edit"/>
			<InspectorControls>
				<PanelBody title="Настройки">
					<ReactSortable
						handle=".handle"
						list={items}
						setList={onSortEnd}
						className="carousel-inspector">
						{items.map((item) =>
							<div className="carousel-setting">
								<Button className="handle" icon="move"/>
								<div className="carousel-setting-inner">
									<TextControl value={item.title} onChange={title => changeTitle(title, item.id)}/>
									<TextareaControl value={item.subtitle} onChange={subtitle => changeSubtitle(subtitle, item.id)}/>
									<MediaUploadCheck>
										<MediaUpload
											onSelect={media => changeImg(media, item.id)}
											allowedTypes={["image"]}
											render={({open}) => (
												<div className="media-block">
													<button onClick={open}>
														Выбрать
													</button>
													<img alt="" src={item.img.src} width="100" height="100"/>
												</div>
											)}
										/>
									</MediaUploadCheck>
								</div>
							</div>
						)}
					</ReactSortable>
					<Button onClick={addItem} icon="plus-alt" label="More"/>
				</PanelBody>
			</InspectorControls>
		</>
	);
}
