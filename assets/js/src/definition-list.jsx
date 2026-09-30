import { registerBlockType } from '@wordpress/blocks';
import { InnerBlocks, useBlockProps, useInnerBlocksProps } from '@wordpress/block-editor';
import { __ } from '@wordpress/i18n';

const allowedBlocks = [ 'wp-yomigana/term', 'wp-yomigana/description' ];

registerBlockType( 'wp-yomigana/dl', {

  apiVersion: 3,

  title: __( 'Definition List', 'wp-yomigana' ),

  icon: (
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 240 240">
      <rect x="20" y="21.5" width="100" height="30"/>
      <rect x="20" y="60" width="200" height="20"/>
      <rect x="20" y="91.5" width="100" height="30"/>
      <rect x="20" y="130" width="200" height="20"/>
      <rect x="20" y="161.5" width="100" height="30"/>
      <rect x="20" y="200" width="200" height="20"/>
    </svg>
  ),

  category: 'text',

  keywords: [],

  edit(){
    const innerBlocksProps = useInnerBlocksProps( useBlockProps(), { allowedBlocks, templateLock: false } );
    return <div { ...innerBlocksProps } />;
  },

  save(){
    return (
      <dl { ...useBlockProps.save() }>
        <InnerBlocks.Content />
      </dl>
    )
  }

} );
