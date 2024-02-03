---
date: "2007-02-16 12:00:00"
title: "Crash course in sane Web programming"
---



What the current SOAP fad has done is to make us forget how to build and deploy applications on the Web according to the true [HTTP specification](http://tools.ietf.org/html/rfc2616). Even wikipedia is incredibly confused and confusing with respect to HTTP. It is ridiculously simple, but overly ignored and misrepresented.

<td style="background:#ccc">
GET
                         |<td style="background:#ddd">
Get some resource identified by a URI. This request should not change the state of the resource.<br/>
The resource itself may change over time however. |

<td style="background:#ccc">
POST
                         |<td style="background:#ddd">

 Add a new resource (post a new message, a new comment, a new post, a new file) or modify an existing resource. The provided URI is not the URI of the new resource, but rather the URI of a related resource (for example, the URI of the blog or posting board).
                         |
<td style="background:#ccc">
PUT
                         |<td style="background:#ddd">

 Create or replace a resource having the given URI. This method is idempotent!
                         |
<td style="background:#ccc">
DELETE
                         |<td style="background:#ddd">
Delete a resource.
                         |


What does this mean?

- A POST from should never replace a resource. A POST form cannot be used to edit a post and is __safe__.
- GET queries are stateless. No matter who does the GET, the same result should come out. If I copy and paste a URL in my browser and pass it to someone else, they should end up with the same resource. A GET query cannot create, change or delete a resource. __GETs are safe__. I should always be able to follow a link without fear of deleting or buying something.


As to why this might not work, see what Parand had to say about it.

