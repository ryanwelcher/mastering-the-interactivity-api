const { join } = require("path");

module.exports = {
  defaultValues: {
    namespace: "mastering-iapi",
    customPackageJSON: {
      prettier: "@wordpress/prettier-config",
    },
    icon: "smiley",
    example: {},
    viewScriptModule: "file:./view.js",
    render: "file:./render.php",
    supports: {
      interactive: true,
    },
    customScripts: {
      build: "wp-scripts build --experimental-modules",
      start: "wp-scripts start --experimental-modules",
    },
  },
  pluginTemplatesPath: join(__dirname, "templates/plugin"),
  blockTemplatesPath: join(__dirname, "templates/block/"),
};
