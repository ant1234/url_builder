## URL building.

You should create a class to build URLs, according to the syntax. [Uniform_Resource_Locator](https://en.wikipedia.org/wiki/)

### Requirements:
- the class should be called "URLBuilder".
- the constructor method should receive an *array* with these indexes:
  -'scheme': string (default 'http')
  -'user': string (default null)
  -'pass': string (default null)
  -'host': string (required)
  -'port': string (default '80')
  -'path': string (default '/')
  -'query': array with key/values (default empty array)
  -'fragment': string (default null)
-the constructor method should return an exception if:
 -a *required* index of the array was not set or was empty.
 -the *query* index was not an array.
-the class should have at least one method called "build" that should return the URL as string. Consider abstracting additional methods to build the url.
 -if scheme is empty, then it must use the default value.
 -if the user or pass is empty, then they must not be shown.
 -if the path is empty, then it must use the default value.
 -if the port is 80 or empty, then it must not be shown.
 -if the query is empty, then it must not be shown.
 -if the fragment is empty, then it must not be shown.