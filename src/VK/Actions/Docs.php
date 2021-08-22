<?php

namespace VK\Actions;

use VK\Actions\Enums\Docs\DocsType;
use VK\Client\Enums\VKApiTokenTypes;
use VK\Exceptions\Api\VKApiMessagesDenySendException;
use VK\Exceptions\Api\VKApiParamDocAccessException;
use VK\Exceptions\Api\VKApiParamDocDeleteAccessException;
use VK\Exceptions\Api\VKApiParamDocIdException;
use VK\Exceptions\Api\VKApiParamDocTitleException;
use VK\Exceptions\Api\VKApiSaveFileException;
use VK\Exceptions\VKApiException;
use VK\Exceptions\VKClientException;

class Docs extends Action
{
	/**
	 * Copies a document to a user's or community's document list.
	 *
	 * @param string $access_token
	 * @param array $params 
	 * - @var integer owner_id: ID of the user or community that owns the document. Use a negative value to designate a community ID.
	 * - @var integer doc_id: Document ID.
	 * - @var string access_key: Access key. This parameter is required if 'access_key' was returned with the document's data.
	 * @throws VKClientException
	 * @throws VKApiException
	 * @return mixed
	 */
	public function add(string $access_token, array $params = [], int $apiTokenType = VKApiTokenTypes::USER)
	{
		return $this->request->post('docs.add', $access_token, $params, $apiTokenType);
	}

	/**
	 * Deletes a user or community document.
	 *
	 * @param string $access_token
	 * @param array $params 
	 * - @var integer owner_id: ID of the user or community that owns the document. Use a negative value to designate a community ID.
	 * - @var integer doc_id: Document ID.
	 * @throws VKClientException
	 * @throws VKApiException
	 * @throws VKApiParamDocDeleteAccessException Access to document deleting is denied
	 * @throws VKApiParamDocIdException Invalid document id
	 * @return mixed
	 */
	public function delete(string $access_token, array $params = [], int $apiTokenType = VKApiTokenTypes::USER)
	{
		return $this->request->post('docs.delete', $access_token, $params, $apiTokenType);
	}

	/**
	 * Edits a document.
	 *
	 * @param string $access_token
	 * @param array $params 
	 * - @var integer owner_id: User ID or community ID. Use a negative value to designate a community ID.
	 * - @var integer doc_id: Document ID.
	 * - @var string title: Document title.
	 * - @var array[string] tags: Document tags.
	 * @throws VKClientException
	 * @throws VKApiException
	 * @throws VKApiParamDocAccessException Access to document is denied
	 * @throws VKApiParamDocIdException Invalid document id
	 * @throws VKApiParamDocTitleException Invalid document title
	 * @return mixed
	 */
	public function edit(string $access_token, array $params = [], int $apiTokenType = VKApiTokenTypes::USER)
	{
		return $this->request->post('docs.edit', $access_token, $params, $apiTokenType);
	}

	/**
	 * Returns detailed information about user or community documents.
	 *
	 * @param string $access_token
	 * @param array $params 
	 * - @var integer count: Number of documents to return. By default, all documents.
	 * - @var integer offset: Offset needed to return a specific subset of documents.
	 * - @var DocsType type
	 * - @var integer owner_id: ID of the user or community that owns the documents. Use a negative value to designate a community ID.
	 * @throws VKClientException
	 * @throws VKApiException
	 * @return mixed
	 */
	public function get(string $access_token, array $params = [], int $apiTokenType = VKApiTokenTypes::USER)
	{
		return $this->request->post('docs.get', $access_token, $params, $apiTokenType);
	}

	/**
	 * Returns information about documents by their IDs.
	 *
	 * @param string $access_token
	 * @param array $params 
	 * - @var array[string] docs: Document IDs. Example: , "66748_91488,66748_91455",
	 * @throws VKClientException
	 * @throws VKApiException
	 * @return mixed
	 */
	public function getById(string $access_token, array $params = [], int $apiTokenType = VKApiTokenTypes::USER)
	{
		return $this->request->post('docs.getById', $access_token, $params, $apiTokenType);
	}

	/**
	 * Returns the server address for document upload.
	 *
	 * @param string $access_token
	 * @param array $params 
	 * - @var DocsType type: Document type.
	 * - @var integer peer_id: Destination ID. "For user: 'User ID', e.g. '12345'. For chat: '2000000000' + 'Chat ID', e.g. '2000000001'. For community: '- Community ID', e.g. '-12345'. "
	 * @throws VKClientException
	 * @throws VKApiException
	 * @throws VKApiMessagesDenySendException Can't send messages for users without permission
	 * @return mixed
	 */
	public function getMessagesUploadServer(string $access_token, array $params = [], int $apiTokenType = VKApiTokenTypes::USER)
	{
		return $this->request->post('docs.getMessagesUploadServer', $access_token, $params, $apiTokenType);
	}

	/**
	 * Returns documents types available for current user.
	 *
	 * @param string $access_token
	 * @param array $params 
	 * - @var integer owner_id: ID of the user or community that owns the documents. Use a negative value to designate a community ID.
	 * @throws VKClientException
	 * @throws VKApiException
	 * @return mixed
	 */
	public function getTypes(string $access_token, array $params = [], int $apiTokenType = VKApiTokenTypes::USER)
	{
		return $this->request->post('docs.getTypes', $access_token, $params, $apiTokenType);
	}

	/**
	 * Returns the server address for document upload.
	 *
	 * @param string $access_token
	 * @param array $params 
	 * - @var integer group_id: Community ID (if the document will be uploaded to the community).
	 * @throws VKClientException
	 * @throws VKApiException
	 * @return mixed
	 */
	public function getUploadServer(string $access_token, array $params = [], int $apiTokenType = VKApiTokenTypes::USER)
	{
		return $this->request->post('docs.getUploadServer', $access_token, $params, $apiTokenType);
	}

	/**
	 * Returns the server address for document upload onto a user's or community's wall.
	 *
	 * @param string $access_token
	 * @param array $params 
	 * - @var integer group_id: Community ID (if the document will be uploaded to the community).
	 * @throws VKClientException
	 * @throws VKApiException
	 * @return mixed
	 */
	public function getWallUploadServer(string $access_token, array $params = [], int $apiTokenType = VKApiTokenTypes::USER)
	{
		return $this->request->post('docs.getWallUploadServer', $access_token, $params, $apiTokenType);
	}

	/**
	 * Saves a document after [vk.com/dev/upload_files_2|uploading it to a server].
	 *
	 * @param string $access_token
	 * @param array $params 
	 * - @var string file: This parameter is returned when the file is [vk.com/dev/upload_files_2|uploaded to the server].
	 * - @var string title: Document title.
	 * - @var string tags: Document tags.
	 * @throws VKClientException
	 * @throws VKApiException
	 * @throws VKApiSaveFileException Couldn't save file
	 * @return mixed
	 */
	public function save(string $access_token, array $params = [], int $apiTokenType = VKApiTokenTypes::USER)
	{
		return $this->request->post('docs.save', $access_token, $params, $apiTokenType);
	}

	/**
	 * Returns a list of documents matching the search criteria.
	 *
	 * @param string $access_token
	 * @param array $params 
	 * - @var string q: Search query string.
	 * - @var boolean search_own
	 * - @var integer count: Number of results to return.
	 * - @var integer offset: Offset needed to return a specific subset of results.
	 * @throws VKClientException
	 * @throws VKApiException
	 * @return mixed
	 */
	public function search(string $access_token, array $params = [], int $apiTokenType = VKApiTokenTypes::USER)
	{
		return $this->request->post('docs.search', $access_token, $params, $apiTokenType);
	}
}
