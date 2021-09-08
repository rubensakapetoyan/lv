## Subscribe Demo API Usage and Setup


### Setup
For setup workspace on local machine need to do second...
- **Windows** &#13; 

<blockquote>
<pre>
 Not depended.*******
    Create virtual host on apache or nginx server located for 
    Ex. on xampp path 'xampp/apache/conf/extra/httpd_vhosts'
 Depended.*******   
    1. <b>Install via composer ( composer install ) after cloning from repo</b>
    2. run from terminal <b>artisan migrate</artisan> , after <b>artisan db:seed</b> for dummy datas
    3. for listen queue and see on terminal command <b> artisan queue:listen </b> or <b> artisan queue:work </b>
    4. config mail acesses in .env for test used gmail smtp server 
    5. change config in configs/mail.php the from field to sender email
</pre>
</blockquote>

- **Linux** 
<pre>
    /etc/apache2/conf.d 
    /etc/apache2/vhosts ... 
    etc...
</pre>

### Notice

<pre>
    Into dummy data havs: 
        Users  by count 10
        Posts by  count 20
        Websites by count 5    
    
    API functional works with posts and subscribtion relations and can't create or remove the users or websites
</pre>


### Usage

##### Endpoints
<pre>
 Creating subscriber
 
 1. <b>(http|https)://lvtest.local/api/subscription</b> with method POST
    body {
        "subscriber":  user id which subscribes to related website  (Ex. 3) 
        "website":    website id (5)
    }
 
    response {
        "status": "ok",
        "subscribed": {
            "id": 6,
            "subscriber": "3",
            "website": "5"
        }
    }
    
    For except dublicates 
        response {
            "status": "o",
            "errors": [
                "This subscriber already subscribed on related website"
            ]
        }
    
 Post endpoints
 Create
 
 2. <b>(http|https)://lvtest.local/api/post/create</b> with method POST
    body {
        "title": "Some Title",
        "content": "Post Content", 
        "website": website Identificator as Number,
        "user": 
    }
    
    response: {           
        "status": "ok",
        "postId": 56,
        "notice": "Notice successfully set to queue for sending as email."
    }
    
 Update      
 
 3. <b>(http|https)://lvtest.local/api/post/update/{postId}</b>  with method PUT
    {postId} - identificator of posts collection
    
    body: {
        "title": "Not Required",
        "content": "Required", 
        "website": "Not Required",
        "user": "Not Required"
    }
    
    response: {
        "status": "ok",
        "message": "Successfully updated."
    }
  
 Show posts by website id
    
 4. (http|https)://lvtest.local/api/post/per/website/{websiteId}  with method GET
    {websiteId} - identificator of websites collection
    
    body: {}
    response: {
            "status": "ok",
            "posts": [ website posts in array ]
    }
    
 5. (http|https)://lvtest.local/api/post/all  with method GET
     body: {}
     response: {
            "status": "ok",
            "posts": [ all posts ]
     }
     
 Remove Post
 6. (http|https)://lvtest.local/api/post/remove/{id}  with method DELETE   
    {id} - identificator of posts collection
    
    body: {}
    response: {
        "status": "ok",
        "message": "Successfully removed."
    }
    
</pre>


