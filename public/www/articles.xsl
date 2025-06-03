<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">

  <xsl:output method="html" indent="yes"/>

  <xsl:template match="/">
    <html>
      <head>
        <title>Articles</title>
        <style>
          .article {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #f9f9f9;
          }
          .article a {
            text-decoration: none;
            color: inherit;
            display: block;
          }
          .article h2 {
            margin: 0;
            color: #333;
          }
          .article p {
            color: #666;
          }
        </style>
      </head>
      <body>
        <xsl:for-each select="articles/article">
          <div class="article">
            <a>
              <xsl:attribute name="href">article</xsl:attribute>
              <xsl:attribute name="id">
                <xsl:value-of select="translate(title, ' ', '-')"/>
              </xsl:attribute>
              <h2><xsl:value-of select="title"/></h2>
              <p>Description</p> <!-- Placeholder -->
            </a>
          </div>
        </xsl:for-each>
      </body>
    </html>
  </xsl:template>

</xsl:stylesheet>