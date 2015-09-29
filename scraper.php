<?
import urllib2
import re
import random
  
url = "https://www.google.nl/search?q=Crowdzu&es_sm=91&source=lnms&tbm=isch&sa=X&ved=0CAcQ_AUoAWoVChMIy5e7youcyAIVyT0aCh02YgQ6&biw=2560&bih=1278"
user_agent = 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36'
#we need to put the user agent into a header format..
headers = {'User-Agent':user_agent,}
  
#we also need to put it into the form of a request for urllib2
search_request = urllib2.Request(url,None,headers)
  
#now we can request and print the data
search_results = urllib2.urlopen(search_request)
search_data = search_results.read()
  
#Now we need to parse the data for links
#our first step is to compile a regular expression
pattern = re.compile('imgurl=([^>]+)&amp;imgrefurl')
#now we can search through the data with the new RE
image_list = pattern.findall(search_data)
  
  
#Its time to select a random link until we get a valid image
while True:
    #choose a random number..
    index = random.randint(0,len(image_list)-1)
    #create the request for urllib2
    image_request = urllib2.Request(image_list[index],None,headers)
    #make sure its a valid link..
    try:
        image_remote = urllib2.urlopen(image_request)
        if image_remote.headers.maintype == 'image':
            break
    except:
        #this is here just so that we have something..
        index = 0
  
#Finally we print the HTMl that the end user will see!
print "Content-type: text/html\n"

// This is a template for a PHP scraper on morph.io (https://morph.io)
// including some code snippets below that you should find helpful

// require 'scraperwiki.php';
// require 'scraperwiki/simple_html_dom.php';
//
// // Read in a page
// $html = scraperwiki::scrape("http://foo.com");
//
// // Find something on the page using css selectors
// $dom = new simple_html_dom();
// $dom->load($html);
// print_r($dom->find("table.list"));
//
// // Write out to the sqlite database using scraperwiki library
// scraperwiki::save_sqlite(array('name'), array('name' => 'susan', 'occupation' => 'software developer'));
//
// // An arbitrary query against the database
// scraperwiki::select("* from data where 'name'='peter'")

// You don't have to do things with the ScraperWiki library.
// You can use whatever libraries you want: https://morph.io/documentation/php
// All that matters is that your final data is written to an SQLite database
// called "data.sqlite" in the current working directory which has at least a table
// called "data".
?>
