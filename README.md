##### Table of Contents  
* [Overview & Installation](#overview)  
* Tags
  * [exp:simplee\_instagram:comments](#sicomments)  
  * [exp:simplee\_instagram:hash](#sihash)  
  * [exp:simplee\_instagram:likes](#silikes)  
  * [exp:simplee\_instagram:location](#silocation)  
  * [exp:simplee\_instagram:post](#sipost)  
  * [exp:simplee\_instagram:user](#siuser)  
  * [exp:simplee\_instagram:user\_info](#siuserinfo)  
* Models
  * [Instagram Comment]()
  * [Instagram Post]()
  * [Instagram User]()

<a name="overview" />
Overview & Installation
-----------------------

##### Overview

SimplEE Instagram allows you to dynamically pull and cache Instagram Posts by either hashtag or user. Use native ExpressionEngine code to bring social media into your website.

This plugin requires an Instagram Client ID. This can be created [here]. Login to your Instagram account, and under Manage Clients, create a new client. After completion, you will recieve a client id.

##### Requirements

Make sure your system meets the minimum requirements:

1.  ExpressionEngine 2.8 or later

##### Installation

1.  Upload the simplee\_instagram/system/third\_party/simplee\_instagram folder to system/expressionengine/third\_party/
2.  Enter and save your Instagram Client ID into the INSTAGRAM\_DEVELOPER\_ID variable in simplee\_instagram/config.php
3.  Enjoy.

##### Updating

1.  Replace the system/expressionengine/third\_party/simplee\_instagram with the simplee\_instagram/system/third\_party/simplee\_instagram folder
2.  Enjoy.




<a name="sicomments" href="#sicomments" />
exp:simplee\_instagram:comments
-------------------------------

The comments tag returns comments given a specified post id. The hash, post, and user tag already returnes comments in a variable pair, and should be used in most cases. This tag should be used for hard coding specific comments only.

| Parameter | Required | Default | Description |
| --------- | -------- | ------- | ----------- |
| client_id | yes | | The developer id required by Instagram to pull posts. This can be entered into each individual ExpressionEngine tag, or set in the system/third\_party/gramee/config.php file. To get a client\_id, follow the steps in the Installation / Updating. |
| id | yes | | The id of the Instagram post that will be returned. |
| limit | no | 25 | The number of comments returned. |
| reverse | no | no | Reverse the order of the comments returned from Instagram. |

| Variable | Description |
| -------- | ----------- |
| date | The date the comment was posted. |
| id | The unique id of the comment. |
| text | The content of the comment, includes hashtags and user handles. |
| user | The user that submitted the comment, to view all variables and options view the [User Model].view the User Model for more all variables. |




<a name="sihash" />
exp:simplee\_instagram:hash
-------------------------------

The hash tag allows you to retrieve Instagram posts filtered by the desired hashtag. This tag will not return private posts, or hashtags that are placed simply in comments rather than the caption.

| Parameter | Required | Default | Description |
| --------- | -------- | ------- | ----------- |
| client_id | yes | | The developer id required by Instagram to pull posts. This can be entered into each individual ExpressionEngine tag, or set in the system/third\_party/gramee/config.php file. To get a client\_id, follow the steps in the Installation / Updating. |
| hash | yes | | The hashtag used to filter posts from Instagram. |
| limit | no | 25 | The number of comments returned. |
| reverse | no | no | Reverse the order of the comments returned from Instagram. |

| Variable | Description |
| -------- | ----------- |
| caption | The caption of the post, including hashtags |
| comments | The comments linked to the post. |
| date | The date the comment was posted. |
| filter | Thefilter used on the image or video |
| image | The url of the image, if it exists |
| likes | The number of likes the post has recieved |
| latitude | The latitude of the post if location was available. |
| link | The link to the post on Instagram |
| location | The name of the location if location was available. |
| longitude | The longitude of the post if location was available. |
| low_resolution | The low resolution version of the image or video. |
| tags | The tags associated with this post. |
| thumbnail | The thumbnail of the post's image or video. |
| type | The type of the Instagram post, can either be image or video. |
| video | The url of the video, if it exists. |
| user | The user that submitted the comment, to view all variables and options view the [User Model].view the User Model for more all variables. |



<a name="silikes" />
exp:simplee\_instagram:likes
-------------------------------

| Parameter | Required | Default | Description |
| --------- | -------- | ------- | ----------- |
| client_id | yes | | The developer id required by Instagram to pull posts. This can be entered into each individual ExpressionEngine tag, or set in the system/third\_party/gramee/config.php file. To get a client\_id, follow the steps in the Installation / Updating. |
| hash | yes | | The hashtag used to filter posts from Instagram. |
| limit | no | 25 | The number of comments returned. |
| reverse | no | no | Reverse the order of the comments returned from Instagram. |

| Variable | Description |
| -------- | ----------- |
| full_name | The full name of the user. |
| followers | The number of people following the user. Only available in user_info tag. |
| follows | The number of people the user is following. Only available in user_info tag. |
| id | The numerical id of the user. |
| media\_count | The total posts the user has submitted. Only available in user_info tag. |
| picture | The profile picture of the user. |
| username | The username or handle of the user. |



<a name="silocation" />
exp:simplee\_instagram:location
-------------------------------

The location tag returns Instagram posts that have been tagged with the corresponding FourSquare id.

| Parameter | Required | Default | Description |
| --------- | -------- | ------- | ----------- |
| client_id | yes | | The developer id required by Instagram to pull posts. This can be entered into each individual ExpressionEngine tag, or set in the system/third\_party/gramee/config.php file. To get a client\_id, follow the steps in the Installation / Updating. |
| id | yes | | The FourSquare id of the location, this is difficult on getting and I am working on finding a faster solution for you. |
| limit | no | 25 | The number of comments returned. |
| reverse | no | no | Reverse the order of the comments returned from Instagram. |

| Variable | Description |
| -------- | ----------- |
| caption | The caption of the post, including hashtags |
| comments | The comments linked to the post. |
| date | The date the comment was posted. |
| filter | Thefilter used on the image or video |
| image | The url of the image, if it exists |
| likes | The number of likes the post has recieved |
| latitude | The latitude of the post if location was available. |
| link | The link to the post on Instagram |
| location | The name of the location if location was available. |
| longitude | The longitude of the post if location was available. |
| low_resolution | The low resolution version of the image or video. |
| tags | The tags associated with this post. |
| thumbnail | The thumbnail of the post's image or video. |
| type | The type of the Instagram post, can either be image or video. |
| video | The url of the video, if it exists. |
| user | The user that submitted the comment, to view all variables and options view the [User Model].view the User Model for more all variables. |




<a name="sipost" />
exp:simplee\_instagram:post
-------------------------------

The post tag will return a single Instagram post, specified by it's id.

| Parameter | Required | Default | Description |
| --------- | -------- | ------- | ----------- |
| client_id | yes | | The developer id required by Instagram to pull posts. This can be entered into each individual ExpressionEngine tag, or set in the system/third\_party/gramee/config.php file. To get a client\_id, follow the steps in the Installation / Updating. |
| id | yes | | The Instagram Post id. |

| Variable | Description |
| -------- | ----------- |
| caption | The caption of the post, including hashtags |
| comments | The comments linked to the post. |
| date | The date the comment was posted. |
| filter | Thefilter used on the image or video |
| image | The url of the image, if it exists |
| likes | The number of likes the post has recieved |
| latitude | The latitude of the post if location was available. |
| link | The link to the post on Instagram |
| location | The name of the location if location was available. |
| longitude | The longitude of the post if location was available. |
| low_resolution | The low resolution version of the image or video. |
| tags | The tags associated with this post. |
| thumbnail | The thumbnail of the post's image or video. |
| type | The type of the Instagram post, can either be image or video. |
| video | The url of the video, if it exists. |
| user | The user that submitted the comment, to view all variables and options view the [User Model].view the User Model for more all variables. |




<a name="siuser" />
exp:simplee\_instagram:user
-------------------------------

The user tag is used to return posts from a specified user. The user's numberical id is needed, and can obtained from this website.

| Parameter | Required | Default | Description |
| --------- | -------- | ------- | ----------- |
| client_id | yes | | The developer id required by Instagram to pull posts. This can be entered into each individual ExpressionEngine tag, or set in the system/third\_party/gramee/config.php file. To get a client\_id, follow the steps in the Installation / Updating. |
| user_id | yes | | The numberical user id for the posts that will be returned. This field is required unless username is used. |
| username | yes | | The handle of the user, without the '@' for the posts that will be returned. The field is required unless user_id is used. |
| limit | no | 25 | The number of comments returned. |
| reverse | no | no | Reverse the order of the comments returned from Instagram. |

| Variable | Description |
| -------- | ----------- |
| caption | The caption of the post, including hashtags |
| comments | The comments linked to the post. |
| date | The date the comment was posted. |
| filter | Thefilter used on the image or video |
| image | The url of the image, if it exists |
| likes | The number of likes the post has recieved |
| latitude | The latitude of the post if location was available. |
| link | The link to the post on Instagram |
| location | The name of the location if location was available. |
| longitude | The longitude of the post if location was available. |
| low_resolution | The low resolution version of the image or video. |
| tags | The tags associated with this post. |
| thumbnail | The thumbnail of the post's image or video. |
| type | The type of the Instagram post, can either be image or video. |
| video | The url of the video, if it exists. |
| user | The user that submitted the comment, to view all variables and options view the [User Model].view the User Model for more all variables. |




<a name="siuserinfo" />
exp:simplee\_instagram:user\_info
-------------------------------

The user_info tag returns the user's profile information, including the number of followers and following.

| Parameter | Required | Default | Description |
| --------- | -------- | ------- | ----------- |
| client_id | yes | | The developer id required by Instagram to pull posts. This can be entered into each individual ExpressionEngine tag, or set in the system/third\_party/gramee/config.php file. To get a client\_id, follow the steps in the Installation / Updating. |
| user_id | yes | | The numberical user id for the posts that will be returned. This field is required unless username is used. |
| username | yes | | The handle of the user, without the '@' for the posts that will be returned. The field is required unless user_id is used. |

| Variable | Description |
| -------- | ----------- |
| full_name | The full name of the user. |
| followers | The number of people following the user. Only available in user_info tag. |
| follows | The number of people the user is following. Only available in user_info tag. |
| id | The numerical id of the user. |
| media\_count | The total posts the user has submitted. Only available in user_info tag. |
| picture | The profile picture of the user. |
| username | The username or handle of the user. |