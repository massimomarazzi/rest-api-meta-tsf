# rest-api-meta-tsf
WordPress Plugin export The Seo Framework data into WordPress Rest API posts and pages endpoint under meta.

Usefull if you use Gatsby with WordPress.
In your `src/templates/post.js` make GraphQl query
  
```
export const query = graphql`
 query( $wpid: Int! ) {
   wordpressPost ( wordpress_id:{ eq:$wpid } ){
           id
           slug
           title
           content
           excerpt
           date
           modified
           meta{
             _genesis_title
             _genesis_description
           }
           
     }
   }
 `  
```

More info:
* [Gatsby](https://www.gatsbyjs.org)
* [Plugin Gatsby Source WordPress](https://www.gatsbyjs.org/packages/gatsby-source-wordpress/?=wordpress)
* [The Seo Framework](https://theseoframework.com/)  
* [register_meta](https://developer.wordpress.org/reference/functions/register_meta/)