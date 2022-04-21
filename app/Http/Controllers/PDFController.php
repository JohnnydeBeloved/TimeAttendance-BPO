<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use PDF;



class PDFController extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function generatePDF()

    {

        $data = [

            'title' => 'Welcome to PDF Test',

            'date' => date('D M d,Y')

        ];



        $pdf = PDF::loadView('myPDF', $data);



        return $pdf->download('itsolutionstuff.pdf');
    }
}
