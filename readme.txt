=== Bamboo Enquiries ===
Contributors: Bamboo Solutions
Donate link: http://www.bamboosolutions.co.uk
Tags: enquiries, contact form, shortcodes
Requires at least: 3.0.1
Tested up to: 3.9.2
Stable tag: 1.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Turn any web form into a flexible enquiry form, enabling you to have multiple enquiry forms throughout your website.

== Description ==

Noodle Enquiries turns any web form into flexible enquiry form, enabling you to have multiple enquiry forms throughout your website. By just wrapping a simple shortcode around the HTML elements of your choice, you can have a professional, simple or complicated email enquiry form up and running in minutes.

It supports all standard form elements, including file uploads. It also provides an ‘auto labels’ option which presents the labels for each input box inside the input as the default value until it is clicked on (the Twitter sign in page is a good example of this in action). Finally the shortcode also supports mandatory text boxes, the form will not be submitted if any mandatory boxes have not be filled in. Simply adding as asterisk (*) to the end of a label will indicate that the following input is mandatory, e.g. :

     <label>Email Address *</label><input type="text" name="email address" />

Usage

Code your form elements as you normally would, with whichever inputs, radio buttons, selects etc that you need, ensuring that you set the name attribute for each element.

Add at least one submit button e.g:

     <button type=“submit”>Send Enquiry”</button>

Finally, instead of wrapping your form elements in a form tag, simply wrap them in the Bamboo Enquiries shortcode instead:

     [bamboo-enquiry from=“website@bamboosolutions.co.uk” to=“enquiries@bamboosolutions.co.uk” auto_labels="on"]
          Your form elements here (don’t forget the submit button)
     [/bamboo-enquiry]

The ‘from’ attribute sets the email address that the enquiry will be sent from, and the ‘to’ attribute sets the address it will be sent to. The ‘auto_labels’ attribute actives the auto labels feature as described above.