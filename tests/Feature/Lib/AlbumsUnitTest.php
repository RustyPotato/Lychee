<?php

/**
 * We don't care for unhandled exceptions in tests.
 * It is the nature of a test to throw an exception.
 * Without this suppression we had 100+ Linter warning in this file which
 * don't help anything.
 *
 * @noinspection PhpDocMissingThrowsInspection
 * @noinspection PhpUnhandledExceptionInspection
 */

namespace Tests\Feature\Lib;

use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class AlbumsUnitTest
{
	private TestCase $testCase;

	public function __construct(TestCase $testCase)
	{
		$this->testCase = $testCase;
	}

	/**
	 * Add an album.
	 *
	 * @param string|null $parent_id
	 * @param string      $title
	 * @param int         $expectedStatusCode
	 * @param string|null $assertSee
	 *
	 * @return TestResponse
	 */
	public function add(
		?string $parent_id,
		string $title,
		int $expectedStatusCode = 201,
		?string $assertSee = null
	): TestResponse {
		$response = $this->testCase->postJson('/api/Album::add', [
			'title' => $title,
			'parent_id' => $parent_id,
		]);
		$response->assertStatus($expectedStatusCode);
		if ($assertSee) {
			$response->assertSee($assertSee, false);
		}

		return $response;
	}

	/**
	 * Add an album.
	 *
	 * @param string      $title
	 * @param string[]    $tags
	 * @param int         $expectedStatusCode
	 * @param string|null $assertSee
	 *
	 * @return TestResponse
	 */
	public function addByTags(
		string $title,
		array $tags,
		int $expectedStatusCode = 201,
		?string $assertSee = null
	): TestResponse {
		$response = $this->testCase->postJson('/api/Album::addByTags', [
			'title' => $title,
			'tags' => $tags,
		]);
		$response->assertStatus($expectedStatusCode);
		if ($assertSee) {
			$response->assertSee($assertSee, false);
		}

		return $response;
	}

	/**
	 * Move albums.
	 *
	 * @param string[]    $ids
	 * @param string|null $to
	 * @param int         $expectedStatusCode
	 * @param string|null $assertSee
	 */
	public function move(
		array $ids,
		?string $to,
		int $expectedStatusCode = 204,
		?string $assertSee = null
	): void {
		$response = $this->testCase->postJson('/api/Album::move', [
			'albumID' => $to,
			'albumIDs' => $ids,
		]);
		$response->assertStatus($expectedStatusCode);
		if ($assertSee) {
			$response->assertSee($assertSee, false);
		}
	}

	/**
	 * Get album by ID.
	 *
	 * @param string      $id
	 * @param int         $expectedStatusCode
	 * @param string|null $assertSee
	 * @param string|null $assertDontSee
	 *
	 * @return TestResponse
	 */
	public function get(
		string $id,
		int $expectedStatusCode = 200,
		?string $assertSee = null,
		?string $assertDontSee = null
	): TestResponse {
		$response = $this->testCase->postJson(
			'/api/Album::get',
			['albumID' => $id]
		);
		$response->assertStatus($expectedStatusCode);
		if ($assertSee) {
			$response->assertSee($assertSee, false);
		}
		if ($assertDontSee) {
			$response->assertDontSee($assertDontSee, false);
		}

		return $response;
	}

	/**
	 * @param string      $id
	 * @param string      $password
	 * @param int         $expectedStatusCode
	 * @param string|null $assertSee
	 */
	public function unlock(
		string $id,
		string $password = '',
		int $expectedStatusCode = 204,
		?string $assertSee = null
	): void {
		$response = $this->testCase->postJson(
			'/api/Album::unlock',
			['albumID' => $id, 'password' => $password]
		);
		$response->assertStatus($expectedStatusCode);
		if ($assertSee) {
			$response->assertSee($assertSee, false);
		}
	}

	/**
	 * Change title.
	 *
	 * @param string      $id
	 * @param string      $title
	 * @param int         $expectedStatusCode
	 * @param string|null $assertSee
	 */
	public function set_title(
		string $id,
		string $title,
		int $expectedStatusCode = 204,
		?string $assertSee = null
	): void {
		$response = $this->testCase->postJson(
			'/api/Album::setTitle',
			['albumIDs' => [$id], 'title' => $title]
		);
		$response->assertStatus($expectedStatusCode);
		if ($assertSee) {
			$response->assertSee($assertSee, false);
		}
	}

	/**
	 * Change description.
	 *
	 * @param string      $id
	 * @param string      $description
	 * @param int         $expectedStatusCode
	 * @param string|null $assertSee
	 */
	public function set_description(
		string $id,
		string $description,
		int $expectedStatusCode = 204,
		?string $assertSee = null
	): void {
		$response = $this->testCase->postJson(
			'/api/Album::setDescription',
			['albumID' => $id, 'description' => $description]
		);
		$response->assertStatus($expectedStatusCode);
		if ($assertSee) {
			$response->assertSee($assertSee, false);
		}
	}

	/**
	 * Set the licence.
	 *
	 * @param string      $id
	 * @param string      $license
	 * @param int         $expectedStatusCode
	 * @param string|null $assertSee
	 */
	public function set_license(
		string $id,
		string $license,
		int $expectedStatusCode = 204,
		?string $assertSee = null
	): void {
		$response = $this->testCase->postJson('/api/Album::setLicense', [
			'albumID' => $id,
			'license' => $license,
		]);
		$response->assertStatus($expectedStatusCode);
		if ($assertSee) {
			$response->assertSee($assertSee, false);
		}
	}

	/**
	 * Set sorting.
	 *
	 * @param string      $id
	 * @param string      $sortingCol
	 * @param string      $sortingOrder
	 * @param int         $expectedStatusCode
	 * @param string|null $assertSee
	 */
	public function set_sorting(
		string $id,
		string $sortingCol,
		string $sortingOrder,
		int $expectedStatusCode = 204,
		?string $assertSee = null
	): void {
		$response = $this->testCase->postJson('/api/Album::setSorting', [
			'albumID' => $id,
			'sorting_column' => $sortingCol,
			'sorting_order' => $sortingOrder,
		]);
		$response->assertStatus($expectedStatusCode);
		if ($assertSee) {
			$response->assertSee($assertSee, false);
		}
	}

	/**
	 * @param string      $id
	 * @param bool        $full_photo
	 * @param bool        $public
	 * @param bool        $requiresLink
	 * @param bool        $nsfw
	 * @param bool        $downloadable
	 * @param bool        $share_button_visible
	 * @param string|null $password             `null` does not change password
	 *                                          settings;
	 *                                          the empty string `''` removes
	 *                                          a (potentially set) password;
	 *                                          a non-empty string sets the
	 *                                          password accordingly
	 * @param int         $expectedStatusCode
	 * @param string|null $assertSee
	 */
	public function set_protection_policy(
		string $id,
		bool $full_photo = true,
		bool $public = true,
		bool $requiresLink = false,
		bool $nsfw = false,
		bool $downloadable = true,
		bool $share_button_visible = true,
		?string $password = null,
		int $expectedStatusCode = 204,
		?string $assertSee = null
	): void {
		$params = [
			'grants_full_photo' => $full_photo,
			'albumID' => $id,
			'is_public' => $public,
			'requires_link' => $requiresLink,
			'is_nsfw' => $nsfw,
			'is_downloadable' => $downloadable,
			'is_share_button_visible' => $share_button_visible,
		];

		if ($password !== null) {
			$params['password'] = $password;
		}

		$response = $this->testCase->postJson('/api/Album::setProtectionPolicy', $params);
		$response->assertStatus($expectedStatusCode);
		if ($assertSee) {
			$response->assertSee($assertSee, false);
		}
	}

	/**
	 * @param string      $id
	 * @param string[]    $tags
	 * @param int         $expectedStatusCode
	 * @param string|null $assertSee
	 */
	public function set_tags(
		string $id,
		array $tags,
		int $expectedStatusCode = 204,
		?string $assertSee = null
	): void {
		$response = $this->testCase->postJson('/api/Album::setShowTags', [
			'albumID' => $id,
			'show_tags' => $tags,
		]);
		$response->assertStatus($expectedStatusCode);
		if ($assertSee) {
			$response->assertSee($assertSee, false);
		}
	}

	/**
	 * We only test for a code 200.
	 *
	 * @param string $id
	 *
	 * @return TestResponse
	 */
	public function download(string $id): TestResponse
	{
		$response = $this->testCase->getWithParameters(
			'/api/Album::getArchive', [
				'albumIDs' => $id,
			], [
				'Accept' => '*/*',
			]
		);
		$response->assertOk();

		return $response;
	}

	/**
	 * Delete.
	 *
	 * @param string[]    $ids
	 * @param int         $expectedStatusCode
	 * @param string|null $assertSee
	 */
	public function delete(
		array $ids,
		int $expectedStatusCode = 204,
		?string $assertSee = null
	): void {
		$response = $this->testCase->postJson('/api/Album::delete', ['albumIDs' => $ids]);
		$response->assertStatus($expectedStatusCode);
		if ($assertSee) {
			$response->assertSee($assertSee, false);
		}
	}

	/**
	 * Test position data (Albums).
	 *
	 * @param int         $expectedStatusCode
	 * @param string|null $assertSee
	 *
	 * @return TestResponse
	 */
	public function AlbumsGetPositionDataFull(
		int $expectedStatusCode = 200,
		?string $assertSee = null
	): TestResponse {
		$response = $this->testCase->postJson('/api/Albums::getPositionData');
		$response->assertStatus($expectedStatusCode);
		if ($assertSee) {
			$response->assertSee($assertSee, false);
		}

		return $response;
	}

	/**
	 * Test position data (Album).
	 *
	 * @param string      $id
	 * @param int         $expectedStatusCode
	 * @param string|null $assertSee
	 *
	 * @return TestResponse
	 */
	public function AlbumGetPositionDataFull(
		string $id,
		int $expectedStatusCode = 200,
		?string $assertSee = null
	): TestResponse {
		$response = $this->testCase->postJson('/api/Album::getPositionData', [
			'albumID' => $id,
			'includeSubAlbums' => false,
		]);
		$response->assertStatus($expectedStatusCode);
		if ($assertSee) {
			$response->assertSee($assertSee, false);
		}

		return $response;
	}
}
