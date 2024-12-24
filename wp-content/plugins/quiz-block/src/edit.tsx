import React, { ChangeEvent } from "react";

/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from "@wordpress/i18n";

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { useBlockProps } from "@wordpress/block-editor";
// import { useState } from "@wordpress/interactivity";

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @param {Object}   props               Properties passed to the function.
 * @param {Object}   props.attributes    Available block attributes.
 * @param {Function} props.setAttributes Function that updates individual attributes.
 *
 * @return {Element} Element to render.
 */

// interface Attributes {
//   grassColor: string;
//   skyColor: string;
// }

export const Edit = ({ attributes, setAttributes }) => {
  const blockProps = useBlockProps();

  // const [formData, setFormData] = useState<QuizBlockFormData>({
  //   grassColor: "",
  //   skyColor: "",
  // });

  const handleInputChange = (event: ChangeEvent<HTMLInputElement>) => {
    const { name, value } = event.target;

    setAttributes({
      ...attributes,
      [name]: value,
    });

    console.log(attributes);
  };

  return (
    <div {...blockProps}>
      <input
        type="text"
        name="skyColor"
        value={attributes.skyColor}
        onChange={handleInputChange}
        placeholder="Sky color"
      />

      <input
        type="text"
        name="grassColor"
        value={attributes.grassColor}
        onChange={handleInputChange}
        placeholder="Grass color"
      />
    </div>
  );
};
