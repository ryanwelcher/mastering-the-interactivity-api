const { join } = require("path");

module.exports = {
  defaultValues: {
    namespace: "mastering-iapi",
    customPackageJSON: {
      prettier: "@wordpress/prettier-config",
    },
    category: "mastering-iapi-blocks",
    icon: "image-filter",
    example: {},
    viewScriptModule: "file:./view.js",
    render: "file:./render.php",
    supports: {
      interactive: true,
    },
    textdomain: "mastering-iapi",
    customScripts: {
      build: "wp-scripts build --experimental-modules",
      start: "wp-scripts start --experimental-modules",
    },
    transformer: (view) => {
      return {
        ...view,
        title: `IAPI: data-${view.slug}`,
      };
    },
  },
  pluginTemplatesPath: join(__dirname, "templates/plugin"),
  blockTemplatesPath: join(__dirname, "templates/block/"),
};
