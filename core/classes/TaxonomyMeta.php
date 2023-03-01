<?php


class TaxonomyMeta {
	public $options = null;
	public $prefix = '';

	public function __construct( $options ) {
		$this->options = $options;
		$this->prefix = $this->options['id'] .'_';
		foreach ( $this->options['taxonomy'] as $taxonomy ) {
			add_action($taxonomy . '_edit_form_fields', array(&$this, 'fill'), 10, 2 );
		}
		add_action('edit_term', array(&$this, 'save'), 10,1);
	}

	function fill( $term, $taxonomy ){

		foreach ( $this->options['args'] as $param ) { // для каждого описанного параметра...

			?><tr class="form-field"><?php
			// определяем значение произвольного поля таксономии
			if(!$value = get_metadata('term', $term->term_id, $this->prefix .$param['id'], true)) $value = $param['std'];
			switch ( $param['type'] ) {
				// input[type="text"]
				case 'text':{ ?>
					<th scope="row"><label for="<?php echo $this->prefix .$param['id'] ?>"><?php echo $param['title'] ?></label></th>
					<td>
						<input name="<?php echo $this->prefix .$param['id'] ?>" type="<?php echo $param['type'] ?>" id="<?php echo $this->prefix .$param['id'] ?>" value="<?php echo $value ?>" class="regular-text" />
						<?php if(isset( $param['desc'] ) ) echo '<p class="description">' . $param['desc'] . '</p>'  ?>
					</td>
					<?php
					break;
				}
				// textarea
				case 'textarea':{ ?>
					<th scope="row"><label for="<?php echo $this->prefix .$param['id'] ?>"><?php echo $param['title'] ?></label></th>
					<td>
						<textarea name="<?php echo $this->prefix .$param['id'] ?>" type="<?php echo $param['type'] ?>" id="<?php echo $this->prefix .$param['id'] ?>" value="<?php echo $value ?>" class="large-text" /><?php echo $value ?></textarea>
						<?php if(isset( $param['desc'] ) ) echo '<p class="description">' . $param['desc'] . '</p>'  ?>
					</td>
					<?php
					break;
				}
				// input[type="checkbox"]
				case 'checkbox':{ ?>
					<th scope="row"><label for="<?php echo $this->prefix .$param['id'] ?>"><?php echo $param['title'] ?></label></th>
					<td>
						<label for="<?php echo $this->prefix .$param['id'] ?>"><input name="<?php echo $this->prefix .$param['id'] ?>" type="<?php echo $param['type'] ?>" id="<?php echo $this->prefix .$param['id'] ?>"<?php echo ($value=='on') ? ' checked="checked"' : '' ?> />
							<?php if(isset( $param['desc'] ) ) echo $param['desc']  ?></label>
					</td>
					<?php
					break;
				}
				// select
				case 'select':{ ?>
					<th scope="row"><label for="<?php echo $this->prefix .$param['id'] ?>"><?php echo $param['title'] ?></label></th>
					<td>
						<label for="<?php echo $this->prefix .$param['id'] ?>">
							<select name="<?php echo $this->prefix .$param['id'] ?>" id="<?php echo $this->prefix .$param['id'] ?>"><option>...</option><?php
								foreach($param['args'] as $val=>$name){
									?><option value="<?php echo $val ?>"<?php echo ( $value == $val ) ? ' selected="selected"' : '' ?>><?php echo $name ?></option><?php
								}
								?></select></label>
						<?php if(isset( $param['desc'] ) ) echo '<p class="description">' . $param['desc'] . '</p>'  ?>
					</td>
					<?php
					break;
				}
				// colorPicker
				case 'color':{?>
					<th scope="row">
						<label for="<?php echo $this->prefix .$param['id'] ?>"><?php echo $param['title'] ?></label>
					</th>
					<td>
						<input name="<?php echo $this->prefix .$param['id'] ?>" type="text" value="<?= $value ?>"
						       class="js-color-picker"
						       id="<?php echo $this->prefix .$param['id'] ?>"
						/>
						<?php if(isset( $param['desc'] ) ) echo '<p class="description">' . $param['desc'] . '</p>'  ?>
					</td>
					<?php
					break;
				}
			}
			?></tr><?php

		}

	}

	function save( $term_id ){
		foreach ( $this->options['args'] as $param ) {
			if ( isset( $_POST[ $this->prefix . $param['id'] ] ) && trim( $_POST[ $this->prefix . $param['id'] ] ) ) {
				update_metadata('term', $term_id, $this->prefix . $param['id'], trim($_POST[ $this->prefix . $param['id'] ], '') );
			} else {
				delete_metadata('term', $term_id, $this->prefix . $param['id'], '', false);
			}
		}
	}

}
