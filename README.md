- In order to make requests to APIs, a request must be made to the /authorize request first.

- Requests can be sent to other requests with the auth_token value returned from the request.

- The auth_token value should be sent to other requests in json type via body.

- Example:
"`{ "id": "36 character uuid" }`"

- To use delete and update requests, values must be sent in json type via body.

- Example:
"`{ "id": "36 character uuid", "name": "anything" }`"

- To use the telescope feature, it is sufficient to add /telescope to the end of the url.

- Example:
"`127.0.0.1:8000/telescope`"
