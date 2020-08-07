<?php
namespace App\Services\Contracts;

use Illuminate\Contracts\Filesystem\Filesystem;

interface File
{
    /**
     * @return Filesystem
     */
    public function getFilesystem();

    /**
     * @return mixed
     */
    public function getPath();

    /**
     * @return mixed
     */
    public function getDiskConfig();

    /**
     * @return mixed
     */
    public function getDiskName();

    /**
     * @param string $diskName
     * @return $this
     */
    public function disk($diskName);

    /**
     * Determine if the file exists.
     *
     * @return bool
     */
    public function exists();

    /**
     * Get the contents of the file.
     *
     * @return string
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function get();

    /**
     * Write the contents of the file.
     *
     * @param  string|resource  $contents
     * @param  string  $visibility
     * @return bool
     */
    public function put($contents, $visibility = null);

    /**
     * Get the visibility for the given path.
     *
     * @return string
     */
    public function getVisibility();

    /**
     * Set the visibility for the given path.
     *
     * @param  string  $visibility
     * @return bool
     */
    public function setVisibility($visibility);

    /**
     * Prepend to the file.
     *
     * @param  string  $data
     * @return int
     */
    public function prepend($data);

    /**
     * Append to the file.
     *
     * @param  string  $data
     * @return int
     */
    public function append($data);

    /**
     * Delete the file at the path.
     *
     * @return bool
     */
    public function delete();

    /**
     * Copy the file to a new location.
     *
     * @param  string  $to
     * @return bool
     */
    public function copy($to);

    /**
     * Move the file to a new location.
     *
     * @param  string  $to
     * @return bool
     */
    public function move($to);

    /**
     * Get the file size of the file.
     *
     * @return int
     */
    public function size();

    /**
     * Get the file's last modification time.
     *
     * @return int
     */
    public function lastModified();

    /**
     * Get the mime-type of the file.
     *
     * @return string|false
     */
    public function mimeType();

    /**
     * Get the mime-type of the file.
     *
     * @return string|false
     */
    public function getMimeType();

    /**
     * Get the file's basename
     * Ex: my_file.txt
     *
     * @return string
     */
    public function getBasename();

    /**
     * Get the file's filename
     * Ex: my_file
     *
     * @return string
     */
    public function getFilename();

    /**
     * Get the file's extension
     * Ex: txt
     *
     * @return string
     */
    public function getExtension();
}
