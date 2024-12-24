import React from "react";
import { useBlockProps } from "@wordpress/block-editor";

export const Save = ({ attributes, setAttributes }) => {
  return (
    <div {...useBlockProps.save()}>
      <p>
        Today the sky is {attributes.skyColor} and the grass is{" "}
        {attributes.grassColor}
      </p>
    </div>
  );
};
