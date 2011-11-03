PHP-DocRaptor
=============


PHP-DocRaptor is a simple consumer class for [DocRaptor.com](http://www.docraptor.com)
You will need a DocRaptor account before you can use the class, as it requires a valid API key.

###Usage
    $docraptor = new DocRaptor(YOUR_API_KEY);
    $docraptor->setDocumentContent('<h1>Hello!</h1>')->setDocumentType('pdf')->setTest(true)->setName('output.pdf');
    $file = $docraptor->fetchDocument();

Optionally, the fetchDocument() method takes a filename as an argument.  If you provide
a filename, the class will attempt to write the returned value to the file you provided.