# PHP Markdown
### PHP Markdown Converter 

Markdown is a PHP library for converting markdown to markup.  It is a useful tool 
for creating documentation on a web page.  For example, if your website contains
a blog, wiki pages, any sort of editing from users you could allow them to
style their documents using markdown.

## Supports:
- headings
- italics
- bold
- links
- images

### Headings

``#`` ``<h1>``

``##`` ``<h2>``

``###`` ``<h3>``

``####`` ``<h4>``

``#####`` ``<h5>``

``## This is a Heading Two`` will produce the following markup ``<h2>This is a Heading Two</h2>``

### Italics

``__text__``

Wrap text in ``__`` to make it italics
  
``__this text is italic__`` will produce the following markup ``<em>this text is italic</em>``

### Bold

``**text**``

Wrap text in ``**`` to make it bold

``**this text is bold**`` will produce the following markup ``<strong>this text is bold</strong>``

### Links

``[Text](Hyperlink)``

Create links by inserting the link text in square brackets followed by the hyperlink in normal brackets

[Google](https://google.ie)

``[Google](https://google.ie)`` will product the following markup ``<a href="https://gooogle.ie" target="_blank">Google</a>``

### Images

``![Alt Text](link to image)``

Create images by inserting the alternate text in square brackets followed by the link to the image in normal brackets

![Git Logo](https://assets-cdn.github.com/images/modules/logos_page/GitHub-Logo.png)

``![Git Logo](https://assets-cdn.github.com/images/modules/logos_page/GitHub-Logo.png)`` will produce the following markup ``<img src="https://assets-cdn.github.com/images/modules/logos_page/GitHub-Mark.png" alt="Git Logo" />`` 
