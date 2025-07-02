const tickets = document.querySelectorAll('.ticket')

tickets.forEach(ticket => {
    document.querySelectorAll('.buttonPrint').forEach(button => {
        button.addEventListener('click', function (){
            const ticketCard = this.closest('.ticket')

            if (!ticketCard) return alert("Nie znaleziono biletu.")

            const printWindow = window.open('', '', 'width=800,height=600')
            printWindow.document.write(`
                <html>
                    <head>
                        <title>Bilet</title>
                        <link rel="stylesheet" href="${cssUrl}">
                        <style>
                            @media print {
                                .no-print {
                                    display: none !important;
                                }
                            }
                            body {
                                padding: 1.5rem;
                                font-family: 'Helvetica', sans-serif;
                            }
                            .ticket {
                                max-width: 700px;
                                margin: auto;
                                border: 1px solid #ccc;
                                border-radius: 10px;
                                padding: 20px;
                            }
                            .text-center {
                                text-align: center;
                            }
                            .btn {
                                padding: 8px 16px;
                                border-radius: 5px;
                                border: 1px solid #999;
                                background-color: #f2f2f2;
                                cursor: pointer;
                                margin-top: 10px;
                            }
                        </style>
                    </head>
                    <body>
                        <div class="ticket">
                            ${ticketCard.innerHTML}
                        </div>
                    </body>
                </html>
            `)
            printWindow.document.close()
            printWindow.focus()
            setTimeout(() => {
                printWindow.print()
                printWindow.close()
            }, 500)
        })
    })
})