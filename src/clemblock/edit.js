/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { useBlockProps, RichText, InspectorControls, PanelColorSettings } from '@wordpress/block-editor';
import { PanelBody, TextControl } from '@wordpress/components';
/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './editor.scss';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {Element} Element to render.
 */
export default function Edit({ attributes, setAttributes }) {
	const { text, backgroundColor, borderStyle } = attributes;

	const blockProps = useBlockProps({
		style: {
			backgroundColor: backgroundColor,
			border: borderStyle,
			padding: '1rem'
		}
	});
	return (
		<>
			<InspectorControls>
					<PanelBody title={__('Style du bloc', 'clemblock')} initialOpen={true}>
						<PanelColorSettings
							title={__('Background color', 'clemblock')}
							colorSettings={[
								{
									value: backgroundColor,
									onChange: (newColor) => setAttributes({ backgroundColor: newColor }),
									label: __('Background color', 'clemblock'),
								},
							]}
						/>
						<TextControl
							label={__('Border (ex: 1px solid red)', 'clemblock')}
							value={borderStyle}
							onChange={(newVal) => setAttributes({ borderStyle: newVal })}
						/>
					</PanelBody>
				</InspectorControls>
			<RichText
				{ ...blockProps}
				tagName="p"
				value={text}
				onChange={(newText) => setAttributes({ text: newText })}
				placeholder={__('Anything but a palindrome...', 'clemblock')}
			/>
		</>
	);
}