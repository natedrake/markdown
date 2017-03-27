# PHP Markdown
[![Build Status](https://travis-ci.org/natedrake/Markdown.svg?branch=master)](https://travis-ci.org/natedrake/markdown)
[![Latest Stable Version](https://poser.pugx.org/natedrake/markdown/v/stable)](https://packagist.org/packages/natedrake/markdown)
[![Total Downloads](https://poser.pugx.org/natedrake/markdown/downloads)](https://packagist.org/packages/natedrake/markdown)
[![Latest Unstable Version](https://poser.pugx.org/natedrake/markdown/v/unstable)](https://packagist.org/packages/natedrake/markdown)
[![License](https://poser.pugx.org/natedrake/markdown/license)](https://packagist.org/packages/natedrake/markdown)
[![composer.lock](https://poser.pugx.org/natedrake/markdown/composerlock)](https://packagist.org/packages/natedrake/markdown)

[![Monthly Downloads](https://poser.pugx.org/natedrake/markdown/d/monthly)](https://packagist.org/packages/natedrake/markdown)
[![Daily Downloads](https://poser.pugx.org/natedrake/markdown/d/daily)](https://packagist.org/packages/natedrake/markdown)

## PHP Markdown Converter 

 1. [Headings](https://github.com/natedrake/markdown/blob/master/README.md#headings)
 2. [Italics](https://github.com/natedrake/markdown/blob/master/README.md#italics) 
 3. [Bold](https://github.com/natedrake/markdown/blob/master/README.md#bold)
 4. [Strike Through](https://github.com/natedrake/markdown/blob/master/README.md#strike-through)
 5. [Links](https://github.com/natedrake/markdown/blob/master/README.md#links)
 6. [Images](https://github.com/natedrake/markdown/blob/master/README.md#images)
 7. [Lists](https://github.com/natedrake/markdown/blob/master/README.md#lists)
    - [Unordered List](https://github.com/natedrake/markdown/blob/master/README.md#unordered-lists)
    - [Ordered List](https://github.com/natedrake/markdown/blob/master/README.md#ordered-lists)
 8. [Block Quotes](https://github.com/natedrake/markdown/blob/master/README.md#block-quotes)
 9. [Tables](https://github.com/natedrake/markdown/blob/master/README.md#tables)
 
Markdown is a PHP library for converting markdown to markup.  It is a useful tool 
for creating documentation on a web page.  For example, if your website contains
a blog, wiki pages, any sort of editing from users you could allow them to
style their documents using markdown.

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

### Lists


#### Unordered Lists

````markdown
List
 - item one
 - item two
 - item three
````

will product the following markup

````html
<ul>
    <li>item one</li>
    <li>item two</li>
    <li>item three</li>
</ul>
````

#### Ordered Lists

````markdown
List
 1. item one
 2. item two
 3. item three
````

will product the following markup

````html
<ol>
    <li>item one</li>
    <li>item two</li>
    <li>item three</li>
</ol>
````

### Block Quotes

````markdown
> this is a block quote
````

will product the following markup

````html
<blockquote> this is a block quote</blockquote>
````