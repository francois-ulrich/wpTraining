wp.blocks.registerBlockType("quiz-block/quiz-block", {
  title: "Quiz block",
  icon: "smiley",
  category: "common",
  edit: () => {
    return wp.element.createElement("h3", null, "Admin content");
  },
  save: () => {
    return wp.element.createElement("h3", null, "Front-end content");
  }
})