import createDataPdf from './pdfFileBody';

const makePdf = () => {
    let docInfo = {
        info: {
            title: 'Заказ на сайте Varka',
            author: 'Varka',
            subject: 'Заказ'
        },

        pageSize: 'A4',
        pageOrientation: 'portrait',
        pageMargins: [50, 50, 50, 50],

        header: (currentPage, pageCount) => {
            return {
                text: 'Заказ на сайте Varka, ' + pageCount + ' стр.',
                alignment: 'center',
                margin: [0, 10, 0, 0]
            }
        },

        content: [
            {
                table: {
                    widths: [20, 100, '*', 40, 100],

                    body: createDataPdf(),
                    headerRows: 0
                }
            },
            {
                text: 'Контакты: 8 (914) 792-77-75, info@varka25.ru',
                margin: [30, 50, 0, 0]
            }
        ]
    };

    return pdfMake.createPdf(docInfo);
}

export default makePdf;