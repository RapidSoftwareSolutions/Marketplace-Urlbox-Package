[![](https://scdn.rapidapi.com/RapidAPI_banner.png)](https://rapidapi.com/package/Urlbox/functions?utm_source=RapidAPIGitHub_UrlboxFunctions&utm_medium=button&utm_content=RapidAPI_GitHub)

# Urlbox Package
Automate screenshots of any website
* Domain: [urlbox.io](https://urlbox.io)
* Credentials: apiKey, apiSecret

## How to get credentials: 
1. Navigate to your [Urlbox dashboard](https://urlbox.io/dashboard) 


## Custom datatypes:
 |Datatype|Description|Example
 |--------|-----------|----------
 |Datepicker|String which includes date and time|```2016-05-28 00:00:00```
 |Map|String which includes latitude and longitude coma separated|```50.37, 26.56```
 |List|Simple array|```["123", "sample"]```
 |Select|String with predefined values|```sample```
 |Array|Array of objects|```[{"Second name":"123","Age":"12","Photo":"sdf","Draft":"sdfsdf"},{"name":"adi","Second name":"bla","Age":"4","Photo":"asfserwe","Draft":"sdfsdf"}] ```

## Urlbox.getScreenshot
Generate screenshot from url.

| Field        | Type       | Description
|--------------|------------|----------
| apiKey       | credentials| Your actual urlbox API key which you can get by registering for an account.
| apiSecret    | credentials| Your actual urlbox API secret which you can get by registering for an account.
| format       | Select     | Should be one of either png or jpg depending on which format you want the resulting image
| url          | String     | The URL of the website you want to screenshot.
| width        | Number     | Viewport width of the browser in pixels. Default: 1280.
| height       | Number     | Viewport height of the browser in pixels. Default: 1024.
| selector     | String     | Take a screenshot of the element that matches this selector.
| thumbWidth   | Number     | Width in pixels of the generated thumbnail, leave off for full-size screenshot.
| userAgent    | String     | User-Agent string used to emulate a particular client.
| acceptLang   | String     | Sets an Accept-Language header on requests to the target URL. Default: en-US.
| authorization| String     | Sets an Authorization header on requests to the target URL.
| cookie       | String     | Set a cookie value before taking a screenshot. E.g. OptIn=true. Can be set multiple times to set more than one cookie.
| delay        | Number     | Amount of time to wait in milliseconds before urlbox takes the screenshot.
| waitFor      | String     | Waits for the element specified by this selector to be visible on the page before taking a screenshot.
| timeout      | Number     | Amount of time to wait in milliseconds for the website at url to respond. Default: 30000
| fullPage     | Boolean    | Amount of time to wait in milliseconds for the website at url to respond. Default: false
| flash        | Boolean    | Enable the flash plugin for flash using websites. Default: false
| force        | Boolean    | Take a fresh screenshot instead of getting a cached version. Default: false
| ttl          | Number     | Short for 'time to live'. Number of seconds to keep a screenshot in the cache. Note the default is also the maximum value for this option. Default: 2592000
| quality      | Number     | JPEG only - image quality of resulting screenshot (0-100). Default: 80
| disableJs    | Boolean    | Turn off javascript on target url to prevent popups. Default: false
| retina       | Boolean    | Take a 'retina' or high definition screenshot equivalent to setting a device pixel ratio of 2.0 or @2x. Please note that retina screenshots will be double the normal dimensions and will normally take slightly longer to process due to the much bigger image size. Default: false
| transparent  | Boolean    | If a website has no background color set, the image will have a transparent background (PNG only). Default: false
| click        | String     | Element selector that is clicked before taking a screenshot e.g. #clickme would click the element with id=`clickme`.
| hover        | String     | Element selector that is hovered before taking a screenshot e.g. #hoverme would hover over the element with id=`hoverme`.
| bgColor      | String     | Hex code or css color string. Some websites don't set a body background colour, and will show up as transparent backgrounds with PNG or black when using JPG. Use this setting to set a background colour. If the website explicitly sets a transparent background on the html or body elements, this setting will be overridden.
| cropWidth    | Number     | Crop the width of the screenshot to this size in pixels.
| hideSelector | String     | Hides all elements that match the element selector by setting their style to `display:none !important;`. Useful for hiding popups.
| highlight    | String     | Word to highlight on the page before capturing a screenshot.
| highlightfg  | String     | Text color of the highlighted word. Default: white
| highlightbg  | String     | Text color of the highlighted word. Default: red
| useS3        | Boolean    | Save the screenshot directly to the S3 bucket configured on your account. Default: false
| s3Path       | Boolean    | The s3 path to save the screenshot to in your S3 bucket.

