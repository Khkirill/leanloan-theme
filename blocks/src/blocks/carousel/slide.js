import React from 'react';

export default function Slide({item}) {
	return (
		<div>
			<div className="carousel-cover">
				<img className="carousel-img" src={item.img.src} alt=""/>
				<span className="carousel-hidden-overlay"></span>
			</div>
			<div className="carousel-content">
				<div className="carousel-header">
					<p className="carousel-title">{item.title}</p>
					<p className="carousel-subtitle">{item.subtitle}</p>
				</div>
			</div>
		</div>
	);
}
