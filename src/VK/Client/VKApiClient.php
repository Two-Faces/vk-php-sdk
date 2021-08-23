<?php

namespace VK\Client;

use VK\Actions\Account;
use VK\Actions\Ads;
use VK\Actions\Apps;
use VK\Actions\Auth;
use VK\Actions\Board;
use VK\Actions\Database;
use VK\Actions\Docs;
use VK\Actions\Fave;
use VK\Actions\Friends;
use VK\Actions\Gifts;
use VK\Actions\Groups;
use VK\Actions\Leads;
use VK\Actions\Likes;
use VK\Actions\Market;
use VK\Actions\Messages;
use VK\Actions\Newsfeed;
use VK\Actions\Notes;
use VK\Actions\Notifications;
use VK\Actions\Orders;
use VK\Actions\Pages;
use VK\Actions\Photos;
use VK\Actions\Places;
use VK\Actions\Polls;
use VK\Actions\Search;
use VK\Actions\Secure;
use VK\Actions\Stats;
use VK\Actions\Status;
use VK\Actions\Storage;
use VK\Actions\Stories;
use VK\Actions\Streaming;
use VK\Actions\Users;
use VK\Actions\Utils;
use VK\Actions\Video;
use VK\Actions\Wall;
use VK\Actions\Widgets;
use VK\Client\Enums\VKApiTokenTypes;
use VK\Exceptions\Api\VkApiExecuteCodeCompilationException;
use VK\Exceptions\Api\VkApiExecuteCodeExecutionException;
use VK\Exceptions\VKApiException;
use VK\Exceptions\VKClientException;

class VKApiClient
{
	protected const API_VERSION = '5.101';
	protected const API_HOST = 'https://api.vk.com/method';
	
	private VKApiRequest $request;
	private Account $account;
	private Ads $ads;
	private Apps $apps;
	private Auth $auth;
	private Board $board;
	private Database $database;
	private Docs $docs;
	private Fave $fave;
	private Friends $friends;
	private Gifts $gifts;
	private Groups $groups;
	private Leads $leads;
	private Likes $likes;
	private Market $market;
	private Messages $messages;
	private Newsfeed $newsfeed;
	private Notes $notes;
	private Notifications $notifications;
	private Orders $orders;
	private Pages $pages;
	private Photos $photos;
	private Places $places;
	private Polls $polls;
	private Search $search;
	private Secure $secure;
	private Stats $stats;
	private Status $status;
	private Storage $storage;
	private Stories $stories;
	private Streaming $streaming;
	private Users $users;
	private Utils $utils;
	private Video $video;
	private Wall $wall;
	private Widgets $widgets;
	
	public function __construct(string $api_version = self::API_VERSION, ?string $language = null)
	{
		$this->request = new VKApiRequest($api_version, $language, self::API_HOST);
	}
	
	public function getRequest(): VKApiRequest
	{
		return $this->request;
	}
	
	public function account(): Account
	{
		if (!isset($this->account))
		{
			$this->account = new Account($this->request);
		}
		
		return $this->account;
	}
	
	public function ads(): Ads
	{
		if (!isset($this->ads))
		{
			$this->ads = new Ads($this->request);
		}
		
		return $this->ads;
	}
	
	public function apps(): Apps
	{
		if (!isset($this->apps))
		{
			$this->apps = new Apps($this->request);
		}
		
		return $this->apps;
	}
	
	public function auth(): Auth
	{
		if (!isset($this->auth))
		{
			$this->auth = new Auth($this->request);
		}
		
		return $this->auth;
	}
	
	public function board(): Board
	{
		if (!isset($this->board))
		{
			$this->board = new Board($this->request);
		}
		
		return $this->board;
	}
	
	public function database(): Database
	{
		if (!isset($this->database))
		{
			$this->database = new Database($this->request);
		}
		
		return $this->database;
	}
	
	public function docs(): Docs
	{
		if (!isset($this->docs))
		{
			$this->docs = new Docs($this->request);
		}
		
		return $this->docs;
	}
	
	/**
	 * Executes VKScript code.
	 *
	 * @param string $access_token
	 * @param array $params
	 * @param int $apiTokenType
	 *
	 * @return mixed
	 * @throws VKApiException
	 * @throws VKClientException
	 */
	public function execute(string $access_token, array $params = [], int $apiTokenType = VKApiTokenTypes::USER): mixed
	{
		return $this->request->post('execute', $access_token, $params, $apiTokenType);
	}
	
	public function fave(): Fave
	{
		if (!isset($this->fave))
		{
			$this->fave = new Fave($this->request);
		}
		
		return $this->fave;
	}
	
	public function friends(): Friends
	{
		if (!isset($this->friends))
		{
			$this->friends = new Friends($this->request);
		}
		
		return $this->friends;
	}
	
	public function gifts(): Gifts
	{
		if (!isset($this->gifts))
		{
			$this->gifts = new Gifts($this->request);
		}
		
		return $this->gifts;
	}
	
	public function groups(): Groups
	{
		if (!isset($this->groups))
		{
			$this->groups = new Groups($this->request);
		}
		
		return $this->groups;
	}
	
	public function leads(): Leads
	{
		if (!isset($this->leads))
		{
			$this->leads = new Leads($this->request);
		}
		
		return $this->leads;
	}
	
	public function likes(): Likes
	{
		if (!isset($this->likes))
		{
			$this->likes = new Likes($this->request);
		}
		
		return $this->likes;
	}
	
	public function market(): Market
	{
		if (!isset($this->market))
		{
			$this->market = new Market($this->request);
		}
		
		return $this->market;
	}
	
	public function messages(): Messages
	{
		if (!isset($this->messages))
		{
			$this->messages = new Messages($this->request);
		}
		
		return $this->messages;
	}
	
	public function newsfeed(): Newsfeed
	{
		if (!isset($this->newsfeed))
		{
			$this->newsfeed = new Newsfeed($this->request);
		}
		
		return $this->newsfeed;
	}
	
	public function notes(): Notes
	{
		if (!isset($this->notes))
		{
			$this->notes = new Notes($this->request);
		}
		
		return $this->notes;
	}
	
	public function notifications(): Notifications
	{
		if (!isset($this->notifications))
		{
			$this->notifications = new Notifications($this->request);
		}
		
		return $this->notifications;
	}
	
	public function orders(): Orders
	{
		if (!isset($this->orders))
		{
			$this->orders = new Orders($this->request);
		}
		
		return $this->orders;
	}
	
	public function pages(): Pages
	{
		if (!isset($this->pages))
		{
			$this->pages = new Pages($this->request);
		}
		
		return $this->pages;
	}
	
	public function photos(): Photos
	{
		if (!isset($this->photos))
		{
			$this->photos = new Photos($this->request);
		}
		
		return $this->photos;
	}
	
	public function places(): Places
	{
		if (!isset($this->places))
		{
			$this->places = new Places($this->request);
		}
		
		return $this->places;
	}
	
	public function polls(): Polls
	{
		if (!isset($this->polls))
		{
			$this->polls = new Polls($this->request);
		}
		
		return $this->polls;
	}
	
	public function search(): Search
	{
		if (!isset($this->search))
		{
			$this->search = new Search($this->request);
		}
		
		return $this->search;
	}
	
	public function secure(): Secure
	{
		if (!isset($this->secure))
		{
			$this->secure = new Secure($this->request);
		}
		
		return $this->secure;
	}
	
	public function stats(): Stats
	{
		if (!isset($this->stats))
		{
			$this->stats = new Stats($this->request);
		}
		
		return $this->stats;
	}
	
	public function status(): Status
	{
		if (!isset($this->status))
		{
			$this->status = new Status($this->request);
		}
		
		return $this->status;
	}
	
	public function storage(): Storage
	{
		if (!isset($this->storage))
		{
			$this->storage = new Storage($this->request);
		}
		
		return $this->storage;
	}
	
	public function stories(): Stories
	{
		if (!isset($this->stories))
		{
			$this->stories = new Stories($this->request);
		}
		
		return $this->stories;
	}
	
	public function streaming(): Streaming
	{
		if (!isset($this->streaming))
		{
			$this->streaming = new Streaming($this->request);
		}
		
		return $this->streaming;
	}
	
	public function users(): Users
	{
		if (!isset($this->users))
		{
			$this->users = new Users($this->request);
		}
		
		return $this->users;
	}
	
	public function utils(): Utils
	{
		if (!isset($this->utils))
		{
			$this->utils = new Utils($this->request);
		}
		
		return $this->utils;
	}
	
	public function video(): Video
	{
		if (!isset($this->video))
		{
			$this->video = new Video($this->request);
		}
		
		return $this->video;
	}
	
	public function wall(): Wall
	{
		if (!isset($this->wall))
		{
			$this->wall = new Wall($this->request);
		}
		
		return $this->wall;
	}
	
	public function widgets(): Widgets
	{
		if (!isset($this->widgets))
		{
			$this->widgets = new Widgets($this->request);
		}
		
		return $this->widgets;
	}
}
