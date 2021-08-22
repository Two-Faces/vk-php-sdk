<?php

namespace VK\Actions;

use VK\Actions\Enums\Notes\NotesSort;
use VK\Client\Enums\VKApiTokenTypes;
use VK\Exceptions\Api\VKApiAccessCommentException;
use VK\Exceptions\Api\VKApiAccessNoteCommentException;
use VK\Exceptions\Api\VKApiAccessNoteException;
use VK\Exceptions\Api\VKApiParamNoteIdException;
use VK\Exceptions\VKApiException;
use VK\Exceptions\VKClientException;

class Notes extends Action
{
	/**
	 * Creates a new note for the current user.
	 *
	 * @param string $access_token
	 * @param array $params 
	 * - @var string title: Note title.
	 * - @var string text: Note text.
	 * - @var array[string] privacy_view
	 * - @var array[string] privacy_comment
	 * @throws VKClientException
	 * @throws VKApiException
	 * @return mixed
	 */
	public function add(string $access_token, array $params = [], int $apiTokenType = VKApiTokenTypes::USER)
	{
		return $this->request->post('notes.add', $access_token, $params, $apiTokenType);
	}

	/**
	 * Adds a new comment on a note.
	 *
	 * @param string $access_token
	 * @param array $params 
	 * - @var integer note_id: Note ID.
	 * - @var integer owner_id: Note owner ID.
	 * - @var integer reply_to: ID of the user to whom the reply is addressed (if the comment is a reply to another comment).
	 * - @var string message: Comment text.
	 * - @var string guid
	 * @throws VKClientException
	 * @throws VKApiException
	 * @throws VKApiAccessNoteException Access to note denied
	 * @throws VKApiAccessNoteCommentException You can't comment this note
	 * @return mixed
	 */
	public function createComment(string $access_token, array $params = [], int $apiTokenType = VKApiTokenTypes::USER)
	{
		return $this->request->post('notes.createComment', $access_token, $params, $apiTokenType);
	}

	/**
	 * Deletes a note of the current user.
	 *
	 * @param string $access_token
	 * @param array $params 
	 * - @var integer note_id: Note ID.
	 * @throws VKClientException
	 * @throws VKApiException
	 * @throws VKApiParamNoteIdException Note not found
	 * @return mixed
	 */
	public function delete(string $access_token, array $params = [], int $apiTokenType = VKApiTokenTypes::USER)
	{
		return $this->request->post('notes.delete', $access_token, $params, $apiTokenType);
	}

	/**
	 * Deletes a comment on a note.
	 *
	 * @param string $access_token
	 * @param array $params 
	 * - @var integer comment_id: Comment ID.
	 * - @var integer owner_id: Note owner ID.
	 * @throws VKClientException
	 * @throws VKApiException
	 * @throws VKApiAccessNoteException Access to note denied
	 * @throws VKApiAccessCommentException Access to comment denied
	 * @return mixed
	 */
	public function deleteComment(string $access_token, array $params = [], int $apiTokenType = VKApiTokenTypes::USER)
	{
		return $this->request->post('notes.deleteComment', $access_token, $params, $apiTokenType);
	}

	/**
	 * Edits a note of the current user.
	 *
	 * @param string $access_token
	 * @param array $params 
	 * - @var integer note_id: Note ID.
	 * - @var string title: Note title.
	 * - @var string text: Note text.
	 * - @var array[string] privacy_view
	 * - @var array[string] privacy_comment
	 * @throws VKClientException
	 * @throws VKApiException
	 * @throws VKApiParamNoteIdException Note not found
	 * @return mixed
	 */
	public function edit(string $access_token, array $params = [], int $apiTokenType = VKApiTokenTypes::USER)
	{
		return $this->request->post('notes.edit', $access_token, $params, $apiTokenType);
	}

	/**
	 * Edits a comment on a note.
	 *
	 * @param string $access_token
	 * @param array $params 
	 * - @var integer comment_id: Comment ID.
	 * - @var integer owner_id: Note owner ID.
	 * - @var string message: New comment text.
	 * @throws VKClientException
	 * @throws VKApiException
	 * @throws VKApiAccessCommentException Access to comment denied
	 * @return mixed
	 */
	public function editComment(string $access_token, array $params = [], int $apiTokenType = VKApiTokenTypes::USER)
	{
		return $this->request->post('notes.editComment', $access_token, $params, $apiTokenType);
	}

	/**
	 * Returns a list of notes created by a user.
	 *
	 * @param string $access_token
	 * @param array $params 
	 * - @var array[integer] note_ids: Note IDs.
	 * - @var integer user_id: Note owner ID.
	 * - @var integer offset
	 * - @var integer count: Number of notes to return.
	 * - @var NotesSort sort
	 * @throws VKClientException
	 * @throws VKApiException
	 * @throws VKApiParamNoteIdException Note not found
	 * @return mixed
	 */
	public function get(string $access_token, array $params = [], int $apiTokenType = VKApiTokenTypes::USER)
	{
		return $this->request->post('notes.get', $access_token, $params, $apiTokenType);
	}

	/**
	 * Returns a note by its ID.
	 *
	 * @param string $access_token
	 * @param array $params 
	 * - @var integer note_id: Note ID.
	 * - @var integer owner_id: Note owner ID.
	 * - @var boolean need_wiki
	 * @throws VKClientException
	 * @throws VKApiException
	 * @throws VKApiAccessNoteException Access to note denied
	 * @throws VKApiParamNoteIdException Note not found
	 * @return mixed
	 */
	public function getById(string $access_token, array $params = [], int $apiTokenType = VKApiTokenTypes::USER)
	{
		return $this->request->post('notes.getById', $access_token, $params, $apiTokenType);
	}

	/**
	 * Returns a list of comments on a note.
	 *
	 * @param string $access_token
	 * @param array $params 
	 * - @var integer note_id: Note ID.
	 * - @var integer owner_id: Note owner ID.
	 * - @var NotesSort sort
	 * - @var integer offset
	 * - @var integer count: Number of comments to return.
	 * @throws VKClientException
	 * @throws VKApiException
	 * @throws VKApiAccessNoteException Access to note denied
	 * @return mixed
	 */
	public function getComments(string $access_token, array $params = [], int $apiTokenType = VKApiTokenTypes::USER)
	{
		return $this->request->post('notes.getComments', $access_token, $params, $apiTokenType);
	}

	/**
	 * Restores a deleted comment on a note.
	 *
	 * @param string $access_token
	 * @param array $params 
	 * - @var integer comment_id: Comment ID.
	 * - @var integer owner_id: Note owner ID.
	 * @throws VKClientException
	 * @throws VKApiException
	 * @throws VKApiAccessCommentException Access to comment denied
	 * @return mixed
	 */
	public function restoreComment(string $access_token, array $params = [], int $apiTokenType = VKApiTokenTypes::USER)
	{
		return $this->request->post('notes.restoreComment', $access_token, $params, $apiTokenType);
	}
}
