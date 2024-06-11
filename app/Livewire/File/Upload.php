<?php

namespace App\Livewire\File;

use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use Livewire\Component;
use Livewire\WithFileUploads;

class Upload extends Component
{
    use WithFileUploads;

    public $file;

    public $fileData = 0;

    public function render()
    {
        return view('livewire.file.upload');
    }
    //     public function isLikelyHeaderRow($row)
    // {
    //     $expectedHeaders = ['name', 'account_provider', 'account_number', 'amount'];
    //     $rowArray = $row->toArray();

    //     // Check if the row matches the expected headers exactly
    //     return $rowArray === $expectedHeaders;
    // }

    public function isLikelyHeaderRow($row)
    {
        $expectedHeaders = ['name', 'account_provider', 'account_number', 'amount'];
        $rowArray = $row->toArray();

        // Convert both arrays to lowercase for case-insensitive comparison
        $lowerExpectedHeaders = array_map('strtolower', $expectedHeaders);
        $lowerRowArray = array_map('strtolower', $rowArray);

        // Check if the row matches the expected headers exactly
        return $lowerRowArray === $lowerExpectedHeaders;
    }

    public function save()
    {
        $this->validate([
            'file' => 'required',
        ]);

        $fileData = [];
        $expectedHeaders = ['name', 'account_provider', 'account_number', 'amount'];

        $reader = ReaderEntityFactory::createReaderFromFile($this->file->getRealPath());

        try {
            $reader->open($this->file->getRealPath());

            $hasHeaders = false; // Flag to indicate header presence
            $isFileEmpty = true; // Flag to check if file is empty

            foreach ($reader->getSheetIterator() as $sheet) {
                $rowIterator = $sheet->getRowIterator();

                $isFirstRow = true; // Track the first row for header detection
                foreach ($rowIterator as $row) {
                    $isFileEmpty = false; // We found at least one row, so the file is not empty

                    if ($isFirstRow) {
                        // Check if the first row contains likely headers
                        $hasHeaders = $this->isLikelyHeaderRow($row);
                        $isFirstRow = false;

                        if (! $hasHeaders) {
                            // Handle case where no headers are found
                            throw new \Exception('The uploaded file does not have the required headers.');
                        }
                    } else {
                        $rowArray = $row->toArray();
                        if (empty($rowArray) || count($rowArray) < count($expectedHeaders)) {
                            continue; // Skip empty or incomplete rows
                        }

                        $cellValues = array_map('strval', $rowArray);
                        $fileData[] = $cellValues;
                    }
                }
            }

            if ($isFileEmpty) {
                throw new \Exception('The uploaded file is empty.');
            }

            $reader->close();

        } catch (\Exception $e) {
            $reader->close();
            session()->flash('error', 'Error Looping through file: '.$e->getMessage());

            return redirect()->back()->withInput();
        }

        $this->fileData = $fileData;
        session()->put('fileData', json_encode($this->fileData));
        session()->flash('success', 'File uploaded successfully. Now make your changes.');

        return redirect()->route('file.preview');
    }

    // public function save()
    // {
    //     $this->validate([
    //         'file' => 'required',
    //     ]);

    //     $fileData = [];
    //     $expectedHeaders = ['name', 'account_provider', 'account_number', 'amount'];

    //     $reader = ReaderEntityFactory::createReaderFromFile($this->file->getRealPath());

    //     try {
    //         $reader->open($this->file->getRealPath());

    //         foreach ($reader->getSheetIterator() as $sheet) {
    //             $rowIterator = $sheet->getRowIterator();
    //             foreach ($rowIterator as $index => $row) {
    //                 if ($index === 0) continue; // Skip the first row (headers)

    //                 $rowArray = $row->toArray();
    //                 if (empty($rowArray) || count($rowArray) < count($expectedHeaders)) {
    //                     continue; // Skip empty or incomplete rows
    //                 }

    //                 $cellValues = array_map('strval', $rowArray);
    //                 $fileData[] = $cellValues;
    //             }
    //         }

    //         dd($fileData);
    //         $reader->close();
    //     } catch (\Exception $e) {
    //         dd($e->getMessage());
    //             $reader->close();

    //         session()->flash('error', 'Error Looping through file: ' . $e->getMessage());
    //         return redirect()->back()->withInput();
    //     }
    // }
    // public function save()
    // {
    //     $this->validate([
    //         'file' => 'required',
    //     ]);

    //     $expectedHeaders = ['name', 'account_provider', 'account_number', 'amount'];
    //     $fileData = [];
    //     $reader = ReaderEntityFactory::createReaderFromFile($this->file->getRealPath());

    //     try {
    //         $reader->open($this->file->getRealPath());
    //         $sheet = $reader->getSheetIterator()->current();

    //         if ($sheet === null) {
    //             throw new \Exception('The uploaded file is empty or unreadable.');
    //         }

    //         $rowIterator = $sheet->getRowIterator();
    //         $firstRow = $rowIterator->current();

    //         if ($firstRow === null) {
    //             throw new \Exception('The uploaded file is empty.');
    //         }

    //         $firstRowArray = $firstRow->toArray();
    //         if ($firstRowArray !== $expectedHeaders) {
    //             throw new \Exception('The uploaded file does not have the required headers.');
    //         }

    //         foreach ($rowIterator as $index => $row) {
    //             if ($index === 0)
    //                 continue; // Skip the first row (headers)

    //             $rowArray = $row->toArray();
    //             if (empty($rowArray) || count($rowArray) < count($expectedHeaders)) {
    //                 continue; // Skip empty or incomplete rows
    //             }

    //             $cellValues = array_map('strval', $rowArray);
    //             $fileData[] = $cellValues;
    //         }
    //         $reader->close();
    //     } catch (\Exception $e) {
    //         dd($e->getMessage());
    //         $reader->close();

    //         session()->flash('error', 'Error Looping through file: ' . $e->getMessage());
    //         return redirect()->back()->withInput();
    //     }

    //     $this->fileData = $fileData;
    //     session()->put('fileData', json_encode($this->fileData));
    //     session()->flash('success', 'File uploaded successfully. Now make your changes.');

    //     return redirect()->route('file.preview');
    // }

    public function download_sample()
    {
        $headers = [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ];
        $filename = 'sample.xlsx';
        $path = public_path('template/sample.xlsx');

        return response()->download($path, $filename, $headers);
    }
}
