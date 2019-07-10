import React from "react"
import PropTypes from "prop-types"

import Header from "../../_components/Header/header"
import Navigation from "../../_components/Navigation/Navigation";
import "./index.css"

const Layout = ({ children }) => {

  return (
    <div>
      <Header siteTitle={data.site.siteMetadata.title} />

      <div
        style={{
          margin: `0 auto`,
          maxWidth: 960,
          padding: `0px 1.0875rem 1.45rem`,
          paddingTop: 0,
        }}
      >
        <main>{children}</main>
      </div>
    </div>
  )
}

Layout.propTypes = {
  children: PropTypes.node.isRequired,
}

export default Layout
