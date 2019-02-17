<?php


namespace services;


use models\ImageDatabaseEntry;
use models\UploadedFile;
use repositories\ImageRepository;
use utilities\IO;

class ImageService
{
    private $STORAGE_PATH;

    /**
     * @var ImageRepository
     */
    private $imageRepository;

    /**
     * ImageService constructor.
     * @param ImageRepository $imageRepository
     */
    public function __construct(ImageRepository $imageRepository)
    {
        $this->imageRepository = $imageRepository;

        // Ensure output directory exists
        $this->STORAGE_PATH = IO::join_paths(__DIR__, "..", "storage");
        if (!file_exists($this->STORAGE_PATH)) {
            mkdir($this->STORAGE_PATH);
        }
    }

    public function save_image(UploadedFile $image): ImageDatabaseEntry
    {
        $hash = $this->get_image_hash($image);

        // Check if the image has been uploaded before. If it has, we can just reuse it.
        $image_data = $this->imageRepository->get_image_from_filehash($hash);
        if ($image_data) {
            return $image_data;
        }

        $extension = explode("/", $image->type)[1];

        $output_path = IO::join_paths($this->STORAGE_PATH, "$hash.$extension");

        echo "Saving file to: $output_path\n";

        move_uploaded_file($image->tmp_name, $output_path);

        echo "Saved file\n";

        return $this->imageRepository->add_image($hash, $extension);
    }

    private function get_image_hash(UploadedFile $image)
    {
        return hash_file("sha256", $image->tmp_name);
    }

    public function get_image_url(ImageDatabaseEntry $image): string
    {
        return "/api/image/?id=$image->image_id";
    }

    /**
     * Prints the refered image to stdout
     *
     * @param int $image_id
     *
     * @return bool true if the image exists, false otherwise
     */
    public function print_image(int $image_id): bool
    {
        $entry = $this->imageRepository->get_image($image_id);

        if (!$entry) {
            return false;
        }

        $image_path = IO::join_paths($this->STORAGE_PATH, $entry->getFilename());

        $image_info = getimagesize($image_path);

        header("Content-Type: " . $image_info["mine"]);
        header("Content-Length: " . filesize($image_path));

        readfile($image_path);

        return true;
    }

}