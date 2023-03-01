import React, {Component} from 'react';
import {SortableContainer, SortableElement} from 'react-sortable-hoc';
import arrayMove from 'array-move';

export const SortableItem = SortableElement(({value}) => (
	<li tabIndex={0}>{value}</li>
));

export const SortableList = SortableContainer(({items, children}) => {
	return (
		<ul>
			{items.map((value, index) => (
				<SortableItem key={`item-${value}`} index={index} value={value} />
			))}
		</ul>
	);
});



export function Sortable(ListItem, Container = <div/>) {
	class SortableComponent extends Component {
		constructor(props) {
			super(props);
			this.onSortEnd = this.onSortEnd.bind(this);
			this.state = {
				items: ['Item 1', 'Item 2', 'Item 3', 'Item 4', 'Item 5', 'Item 6'],
			};
		}
		onSortEnd ({oldIndex, newIndex}) {
			this.setState(({items}) => ({
				items: arrayMove(items, oldIndex, newIndex),
			}));
		};

		render() {
			const SortableList = SortableContainer(props => <Container><ListItem {...props}/></Container>);
			return <SortableList items={this.state.items} onSortEnd={this.onSortEnd} />;
		}
	}
}
