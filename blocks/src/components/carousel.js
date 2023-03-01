import React from 'react';
import Siema from '../libs/siema';

export function Carousel({PrevControl, NextControl}) {
	const hasPrev = PrevControl !== undefined;
	const hasNext = NextControl !== undefined;
	return class CarouselComponent extends React.Component {
		constructor(props) {
			super(props);
			this.slider = null;
			this.next = this.next.bind(this);
			this.prev = this.prev.bind(this);
			this.state = {
				items: this.props.children
			}
			console.log('constructor')
		}

		componentDidMount() {
			this.slider = new Siema({
				selector: this.el
			});
			console.log('componentDidMount')
		}

		componentDidUpdate(prevProps, prevState, snapshot) {
			if(prevProps.children.length < this.props.children.length) {
				console.log(this.props.children[this.props.children.length - 1])
			}
		}

		componentWillUnmount() {
			this.slider.destroy(true, null);
			console.log('componentWillUnmount')
		}

		next() {
			this.slider.next()
		}

		prev() {
			this.slider.prev()
		}

		render() {
			console.log('render');
			return (
				<div className={`siema carousel ${this.props.className}`} ref={el => this.el = el}>
					{this.state.items}
				</div>
			);
		}
	}
}
