/**
 * Inline popover with a single text input, anchored to the current selection.
 *
 * Enter does not submit: it conflicts with IME conversion of Japanese input.
 */

import { useState } from '@wordpress/element';
import { __ } from '@wordpress/i18n';
import { Popover, TextControl, Button, Flex } from '@wordpress/components';
import { useAnchor } from '@wordpress/rich-text';

export default function InputPopover( { contentRef, settings, label, help, type = 'text', required = false, onSubmit, onClose, onFocusOutside } ) {
  const [ text, setText ] = useState( '' );
  const anchor = useAnchor( { editableContentElement: contentRef.current, settings } );
  const trimmed = text.trim();
  return (
    <Popover anchor={ anchor } placement="bottom" focusOnMount="firstElement" shift
      onClose={ onClose } onFocusOutside={ onFocusOutside } className="wp-yomigana-popover">
      <div style={ { padding: '16px', minWidth: '280px' } }>
        <TextControl __nextHasNoMarginBottom __next40pxDefaultSize
          label={ label } help={ help } type={ type } value={ text } onChange={ setText } />
        <Flex justify="flex-end" style={ { marginTop: '12px' } }>
          <Button variant="tertiary" onClick={ onClose }>{ __( 'Cancel', 'wp-yomigana' ) }</Button>
          <Button variant="primary" disabled={ required && ! trimmed } onClick={ () => onSubmit( trimmed ) }>
            { __( 'Apply', 'wp-yomigana' ) }
          </Button>
        </Flex>
      </div>
    </Popover>
  );
}
