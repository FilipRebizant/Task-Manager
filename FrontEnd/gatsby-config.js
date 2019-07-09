module.exports = {
  siteMetadata: {
    title: `Task-Manager`,
    description: `Task-Manager`,
  },
  proxy: {
    prefix: "/api",
    url: "http://localhost:8080",
  },
  plugins: [
    `gatsby-plugin-react-helmet`,
    {
      resolve: `gatsby-source-filesystem`,
      options: {
        name: `images`,
        path: `${__dirname}/src/assets/images`,
      },
    },
    `gatsby-transformer-sharp`,
    `gatsby-plugin-sharp`,
    {
      resolve: `gatsby-plugin-manifest`,
      options: {
        name: `Task Manager`,
        short_name: `taskmanager`,
        start_url: `/`,
        background_color: `#663399`,
        theme_color: `#663399`,
        display: `standalone`,
        icon: `src/assets/images/gatsby-icon.png`,
      },
    },
    `gatsby-plugin-offline`,
    {
      resolve: `gatsby-plugin-create-client-paths`,
      options: { prefixes: [`/app`] },
    },
    `@wardpeet/gatsby-plugin-static-site`
  ],
};
