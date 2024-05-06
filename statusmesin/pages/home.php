<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar di Tengah dengan Kolom dan Kotak Box</title>
    <style>
        /* Ini hanya contoh styling untuk tampilan */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        nav {
            background-color: #ccc;
            color: black;
            text-align: center;
            padding: 10px 0;
            font-size: large;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            /* Pusatkan item di dalam container */
            align-items: center;
            /* Pusatkan item secara vertikal */
            gap: 2px;
            /* Jarak antar item */
            border-radius: 8px;


        }



        /* Mengatur ukuran semua item menjadi sama */
        .container>div {
            flex: 1 1 300px;
            /* flex-grow, flex-shrink, flex-basis */
            max-width: 100px;
            /* Lebar maksimum item */
            min-width: 90px;
            /* Lebar minimum item */
            height: 2px;
            /* Tinggi item */
            background-color: #f2f2f2;
            border: 2px solid #ccc;
            /* border-radius: 9px; */

            box-sizing: border-box;
            text-align: center;
            margin-bottom: 5px;
            /* Jarak bawah antar item */
        }

        .kolom1 {
            flex: 1 1 300px;
            /* Ubah ukuran relatif menjadi 5% dari lebar container */
            background-color: #f2f2f2;
            padding: 20px;
            border: 1px solid #ddd;
            box-sizing: border-box;
            margin: 2px;
            display: flex;
            justify-content: center;
            align-items: center;

        }

        .kolom {
            flex: 1 1 300px;
            /* Ubah ukuran relatif menjadi 5% dari lebar container */
            background-color: #f2f2f2;
            padding: 10px;
            border: 1px solid #ddd;
            box-sizing: border-box;
            margin: 2px;
            border-radius: 7px;
            display: flex;
            justify-content: center;
            align-items: center;


            /* animation: blink 2s infinite; */

        }

        /* @keyframes blink {
            0% {
                opacity: 1;
            }

            50% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        } */

        .card {
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            transition: 0.3s;
            margin: 20px;
            padding: 20px;
        }

        td {
            padding: 10px;
            border: 1px solid #ccc;
        }

        /* Gaya untuk kotak kecil */
        .small-box1 {
            display: inline-block;
            width: 20px;
            height: 20px;
            background-color: red;
            margin-left: 10px;
            vertical-align: middle;
        }

        .small-box2 {
            display: inline-block;
            width: 20px;
            height: 20px;
            background-color: palegreen;
            margin-left: 10px;
            vertical-align: middle;
        }

        .small-box3 {
            display: inline-block;
            width: 20px;
            height: 20px;
            background-color: palegoldenrod;
            margin-left: 10px;
            vertical-align: middle;
        }

        .small-box4 {
            display: inline-block;
            width: 20px;
            height: 20px;
            background-color: palevioletred;
            margin-left: 10px;
            vertical-align: middle;
        }
    </style>
</head>

<body>
    <nav>
        <h1>STATUS MESIN DEPART FINISHING SUDAH ATUR</h1>
    </nav>
    <div class="card">

        <div class="container" style="text-align: center;">
            <div class="kolom1">ST 01 </div>
            <div class="kolom1">ST 02</div>
            <div class="kolom1">ST 03</div>
            <div class="kolom1">ST 04</div>
            <div class="kolom1">ST 05</div>
            <div class="kolom1">ST 06</div>
            <div class="kolom1">ST 07</div>
            <div class="kolom1">ST 08</div>
            <div class="kolom1">ST 09</div>
            <div class="kolom1">COMPAC 01</div>
            <div class="kolom1">COMPAC 02</div>
            <div class="kolom1">OVEN FONG</div>
            <div class="kolom1">STEAM</div>
            <div class="kolom1">LIPAT/INSPEK</div>
            <div class="kolom1">BC 01/02</div>
            <div class="kolom1">BC 03 </div>
            <div class="kolom1">BC 04</div>
        </div>
        <div class="container">
            <div class="kolom">ST 01 </div>
            <div class="kolom">ST 02</div>
            <div class="kolom">ST 03</div>
            <div class="kolom">ST 04</div>
            <div class="kolom">ST 05</div>
            <div class="kolom">ST 06</div>
            <div class="kolom">ST 07</div>
            <div class="kolom">ST 08</div>
            <div class="kolom">ST 09</div>
            <div class="kolom">COMPAC 01</div>
            <div class="kolom">COMPAC 02</div>
            <div class="kolom">OVEN FONG</div>
            <div class="kolom">STEAM</div>
            <div class="kolom">LIPAT/inspek</div>
            <div class="kolom">BC 01/02</div>
            <div class="kolom">BC 03 </div>
            <div class="kolom">BC 04</div>
        </div>
        <div class="container">
            <div class="kolom">kolom 1</div>
            <div class="kolom">Kolom 2</div>
            <div class="kolom">Kolom 3</div>
            <div class="kolom">Kolom 4</div>
            <div class="kolom">Kolom 5</div>
            <div class="kolom">Kolom 6</div>
            <div class="kolom">Kolom 7</div>
            <div class="kolom">Kolom 8</div>
            <div class="kolom">Kolom 9</div>
            <div class="kolom">Kolom 10</div>
            <div class="kolom">Kolom 11</div>
            <div class="kolom">Kolom 12</div>
            <div class="kolom">Kolom 13</div>
            <div class="kolom">Kolom 14</div>
            <div class="kolom">Kolom 15</div>
            <div class="kolom">Kolom 16</div>
            <div class="kolom">Kolom 17</div>
        </div>
        <div class="container">
            <div class="kolom">kolom 1</div>
            <div class="kolom">Kolom 2</div>
            <div class="kolom">Kolom 3</div>
            <div class="kolom">Kolom 4</div>
            <div class="kolom">Kolom 5</div>
            <div class="kolom">Kolom 6</div>
            <div class="kolom">Kolom 7</div>
            <div class="kolom">Kolom 8</div>
            <div class="kolom">Kolom 9</div>
            <div class="kolom">Kolom 10</div>
            <div class="kolom">Kolom 11</div>
            <div class="kolom">Kolom 12</div>
            <div class="kolom">Kolom 13</div>
            <div class="kolom">Kolom 14</div>
            <div class="kolom">Kolom 15</div>
            <div class="kolom">Kolom 16</div>
            <div class="kolom">Kolom 17</div>
        </div>
        <div class="container">
            <div class="kolom">kolom 1</div>
            <div class="kolom">Kolom 2</div>
            <div class="kolom">Kolom 3</div>
            <div class="kolom">Kolom 4</div>
            <div class="kolom">Kolom 5</div>
            <div class="kolom">Kolom 6</div>
            <div class="kolom">Kolom 7</div>
            <div class="kolom">Kolom 8</div>
            <div class="kolom">Kolom 9</div>
            <div class="kolom">Kolom 10</div>
            <div class="kolom">Kolom 11</div>
            <div class="kolom">Kolom 12</div>
            <div class="kolom">Kolom 13</div>
            <div class="kolom">Kolom 14</div>
            <div class="kolom">Kolom 15</div>
            <div class="kolom">Kolom 16</div>
            <div class="kolom">Kolom 17</div>
        </div>
        <div class="container">
            <div class="kolom">kolom 1</div>
            <div class="kolom">Kolom 2</div>
            <div class="kolom">Kolom 3</div>
            <div class="kolom">Kolom 4</div>
            <div class="kolom">Kolom 5</div>
            <div class="kolom">Kolom 6</div>
            <div class="kolom">Kolom 7</div>
            <div class="kolom">Kolom 8</div>
            <div class="kolom">Kolom 9</div>
            <div class="kolom">Kolom 10</div>
            <div class="kolom">Kolom 11</div>
            <div class="kolom">Kolom 12</div>
            <div class="kolom">Kolom 13</div>
            <div class="kolom">Kolom 14</div>
            <div class="kolom">Kolom 15</div>
            <div class="kolom">Kolom 16</div>
            <div class="kolom">Kolom 17</div>
        </div>
        <div class="container">
            <div class="kolom">kolom 1</div>
            <div class="kolom">Kolom 2</div>
            <div class="kolom">Kolom 3</div>
            <div class="kolom">Kolom 4</div>
            <div class="kolom">Kolom 5</div>
            <div class="kolom">Kolom 6</div>
            <div class="kolom">Kolom 7</div>
            <div class="kolom">Kolom 8</div>
            <div class="kolom">Kolom 9</div>
            <div class="kolom">Kolom 10</div>
            <div class="kolom">Kolom 11</div>
            <div class="kolom">Kolom 12</div>
            <div class="kolom">Kolom 13</div>
            <div class="kolom">Kolom 14</div>
            <div class="kolom">Kolom 15</div>
            <div class="kolom">Kolom 16</div>
            <div class="kolom">Kolom 17</div>
        </div>
        <div class="container">
            <div class="kolom">kolom 1</div>
            <div class="kolom">Kolom 2</div>
            <div class="kolom">Kolom 3</div>
            <div class="kolom">Kolom 4</div>
            <div class="kolom">Kolom 5</div>
            <div class="kolom">Kolom 6</div>
            <div class="kolom">Kolom 7</div>
            <div class="kolom">Kolom 8</div>
            <div class="kolom">Kolom 9</div>
            <div class="kolom">Kolom 10</div>
            <div class="kolom">Kolom 11</div>
            <div class="kolom">Kolom 12</div>
            <div class="kolom">Kolom 13</div>
            <div class="kolom">Kolom 14</div>
            <div class="kolom">Kolom 15</div>
            <div class="kolom">Kolom 16</div>
            <div class="kolom">Kolom 17</div>
        </div>
        <div class="container">
            <div class="kolom">kolom 1</div>
            <div class="kolom">Kolom 2</div>
            <div class="kolom">Kolom 3</div>
            <div class="kolom">Kolom 4</div>
            <div class="kolom">Kolom 5</div>
            <div class="kolom">Kolom 6</div>
            <div class="kolom">Kolom 7</div>
            <div class="kolom">Kolom 8</div>
            <div class="kolom">Kolom 9</div>
            <div class="kolom">Kolom 10</div>
            <div class="kolom">Kolom 11</div>
            <div class="kolom">Kolom 12</div>
            <div class="kolom">Kolom 13</div>
            <div class="kolom">Kolom 14</div>
            <div class="kolom">Kolom 15</div>
            <div class="kolom">Kolom 16</div>
            <div class="kolom">Kolom 17</div>
        </div>
        <div class="container">

            <div class="kolom">kolom 1</div>
            <div class="kolom">Kolom 2</div>
            <div class="kolom">Kolom 3</div>
            <div class="kolom">Kolom 4</div>
            <div class="kolom">Kolom 5</div>
            <div class="kolom">Kolom 6</div>
            <div class="kolom">Kolom 7</div>
            <div class="kolom">Kolom 8</div>
            <div class="kolom">Kolom 9</div>
            <div class="kolom">Kolom 10</div>
            <div class="kolom">Kolom 11</div>
            <div class="kolom">Kolom 12</div>
            <div class="kolom">Kolom 13</div>
            <div class="kolom">Kolom 14</div>
            <div class="kolom">Kolom 15</div>
            <div class="kolom">Kolom 16</div>
            <div class="kolom">Kolom 17</div>
        </div>
        <br>
        <td colspan="2">Keterangan warna <span class="small-box1"></span></td>
        <td colspan="2">Keterangan warna <span class="small-box2"></span></td>
        <td colspan="2">Keterangan warna <span class="small-box3"></span></td>
        <td colspan="2">Keterangan warna <span class="small-box4"></span></td>
        <marquee class="teks-berjalan" behavior="scroll" direction="left" onmouseover="this.stop();" onmouseout="this.start();" style="font-size: larger;">
            UTAMAKAN KESELAMATAN KERJA, TINGKATKAN PRODUKTIFITAS, KURANGI MASALAH, KURANGI LOSS WAKTU DAN JAGA 5R DI LINGKUNGAN KERJA :: UTAMAKAN KESEHATAN DAN KESELAMATAN KERJA, SELALU MENGGUNAKAN ALAT PELINDUNG DIRI, JAGA 5R, DAN SELALU WASPADA TERHADAP PENYEBARAN COVID-19
        </marquee>
    </div>
    <nav>
        <h1>STATUS MESIN DEPART FINISHING BELUM ATUR</h1>
    </nav>
    <div class="card">
        <div class="container">
            <div class="kolom1">ST 01</div>
            <div class="kolom1">ST 02</div>
            <div class="kolom1">ST 03</div>
            <div class="kolom1">ST 4</div>
            <div class="kolom1">ST 5</div>
            <div class="kolom1">ST 6</div>
            <div class="kolom1">ST 7</div>
            <div class="kolom1">ST 8</div>
            <div class="kolom1">ST 9</div>
            <div class="kolom1">COMPAC 01</div>
            <div class="kolom1">COMPAC 02</div>
            <div class="kolom1">OVEN FONG</div>
            <div class="kolom1">STEAM</div>
            <div class="kolom1">LIPAT/inspek</div>
            <div class="kolom1">BC 01/02</div>
            <div class="kolom1">BC 03 </div>
            <div class="kolom1">BC 04</div>
        </div>
        <div class="container">
            <div class="kolom">kolom 1</div>
            <div class="kolom">Kolom 2</div>
            <div class="kolom">Kolom 3</div>
            <div class="kolom">Kolom 4</div>
            <div class="kolom">Kolom 5</div>
            <div class="kolom">Kolom 6</div>
            <div class="kolom">Kolom 7</div>
            <div class="kolom">Kolom 8</div>
            <div class="kolom">Kolom 9</div>
            <div class="kolom">Kolom 10</div>
            <div class="kolom">Kolom 11</div>
            <div class="kolom">Kolom 12</div>
            <div class="kolom">Kolom 13</div>
            <div class="kolom">Kolom 14</div>
            <div class="kolom">Kolom 15</div>
            <div class="kolom">Kolom 16</div>
            <div class="kolom">Kolom 17</div>
        </div>
        <div class="container">
            <div class="kolom">kolom 1</div>
            <div class="kolom">Kolom 2</div>
            <div class="kolom">Kolom 3</div>
            <div class="kolom">Kolom 4</div>
            <div class="kolom">Kolom 5</div>
            <div class="kolom">Kolom 6</div>
            <div class="kolom">Kolom 7</div>
            <div class="kolom">Kolom 8</div>
            <div class="kolom">Kolom 9</div>
            <div class="kolom">Kolom 10</div>
            <div class="kolom">Kolom 11</div>
            <div class="kolom">Kolom 12</div>
            <div class="kolom">Kolom 13</div>
            <div class="kolom">Kolom 14</div>
            <div class="kolom">Kolom 15</div>
            <div class="kolom">Kolom 16</div>
            <div class="kolom">Kolom 17</div>
        </div>
        <div class="container">
            <div class="kolom">kolom 1</div>
            <div class="kolom">Kolom 2</div>
            <div class="kolom">Kolom 3</div>
            <div class="kolom">Kolom 4</div>
            <div class="kolom">Kolom 5</div>
            <div class="kolom">Kolom 6</div>
            <div class="kolom">Kolom 7</div>
            <div class="kolom">Kolom 8</div>
            <div class="kolom">Kolom 9</div>
            <div class="kolom">Kolom 10</div>
            <div class="kolom">Kolom 11</div>
            <div class="kolom">Kolom 12</div>
            <div class="kolom">Kolom 13</div>
            <div class="kolom">Kolom 14</div>
            <div class="kolom">Kolom 15</div>
            <div class="kolom">Kolom 16</div>
            <div class="kolom">Kolom 17</div>
        </div>
        <div class="container">
            <div class="kolom">kolom 1</div>
            <div class="kolom">Kolom 2</div>
            <div class="kolom">Kolom 3</div>
            <div class="kolom">Kolom 4</div>
            <div class="kolom">Kolom 5</div>
            <div class="kolom">Kolom 6</div>
            <div class="kolom">Kolom 7</div>
            <div class="kolom">Kolom 8</div>
            <div class="kolom">Kolom 9</div>
            <div class="kolom">Kolom 10</div>
            <div class="kolom">Kolom 11</div>
            <div class="kolom">Kolom 12</div>
            <div class="kolom">Kolom 13</div>
            <div class="kolom">Kolom 14</div>
            <div class="kolom">Kolom 15</div>
            <div class="kolom">Kolom 16</div>
            <div class="kolom">Kolom 17</div>
        </div>
        <div class="container">
            <div class="kolom">kolom 1</div>
            <div class="kolom">Kolom 2</div>
            <div class="kolom">Kolom 3</div>
            <div class="kolom">Kolom 4</div>
            <div class="kolom">Kolom 5</div>
            <div class="kolom">Kolom 6</div>
            <div class="kolom">Kolom 7</div>
            <div class="kolom">Kolom 8</div>
            <div class="kolom">Kolom 9</div>
            <div class="kolom">Kolom 10</div>
            <div class="kolom">Kolom 11</div>
            <div class="kolom">Kolom 12</div>
            <div class="kolom">Kolom 13</div>
            <div class="kolom">Kolom 14</div>
            <div class="kolom">Kolom 15</div>
            <div class="kolom">Kolom 16</div>
            <div class="kolom">Kolom 17</div>
        </div>
        <div class="container">
            <div class="kolom">kolom 1</div>
            <div class="kolom">Kolom 2</div>
            <div class="kolom">Kolom 3</div>
            <div class="kolom">Kolom 4</div>
            <div class="kolom">Kolom 5</div>
            <div class="kolom">Kolom 6</div>
            <div class="kolom">Kolom 7</div>
            <div class="kolom">Kolom 8</div>
            <div class="kolom">Kolom 9</div>
            <div class="kolom">Kolom 10</div>
            <div class="kolom">Kolom 11</div>
            <div class="kolom">Kolom 12</div>
            <div class="kolom">Kolom 13</div>
            <div class="kolom">Kolom 14</div>
            <div class="kolom">Kolom 15</div>
            <div class="kolom">Kolom 16</div>
            <div class="kolom">Kolom 17</div>
        </div>
        <div class="container">
            <div class="kolom">kolom 1</div>
            <div class="kolom">Kolom 2</div>
            <div class="kolom">Kolom 3</div>
            <div class="kolom">Kolom 4</div>
            <div class="kolom">Kolom 5</div>
            <div class="kolom">Kolom 6</div>
            <div class="kolom">Kolom 7</div>
            <div class="kolom">Kolom 8</div>
            <div class="kolom">Kolom 9</div>
            <div class="kolom">Kolom 10</div>
            <div class="kolom">Kolom 11</div>
            <div class="kolom">Kolom 12</div>
            <div class="kolom">Kolom 13</div>
            <div class="kolom">Kolom 14</div>
            <div class="kolom">Kolom 15</div>
            <div class="kolom">Kolom 16</div>
            <div class="kolom">Kolom 17</div>
        </div>
        <div class="container">
            <div class="kolom">kolom 1</div>
            <div class="kolom">Kolom 2</div>
            <div class="kolom">Kolom 3</div>
            <div class="kolom">Kolom 4</div>
            <div class="kolom">Kolom 5</div>
            <div class="kolom">Kolom 6</div>
            <div class="kolom">Kolom 7</div>
            <div class="kolom">Kolom 8</div>
            <div class="kolom">Kolom 9</div>
            <div class="kolom">Kolom 10</div>
            <div class="kolom">Kolom 11</div>
            <div class="kolom">Kolom 12</div>
            <div class="kolom">Kolom 13</div>
            <div class="kolom">Kolom 14</div>
            <div class="kolom">Kolom 15</div>
            <div class="kolom">Kolom 16</div>
            <div class="kolom">Kolom 17</div>
        </div>
        <div class="container">
            <div class="kolom">kolom 1</div>
            <div class="kolom">Kolom 2</div>
            <div class="kolom">Kolom 3</div>
            <div class="kolom">Kolom 4</div>
            <div class="kolom">Kolom 5</div>
            <div class="kolom">Kolom 6</div>
            <div class="kolom">Kolom 7</div>
            <div class="kolom">Kolom 8</div>
            <div class="kolom">Kolom 9</div>
            <div class="kolom">Kolom 10</div>
            <div class="kolom">Kolom 11</div>
            <div class="kolom">Kolom 12</div>
            <div class="kolom">Kolom 13</div>
            <div class="kolom">Kolom 14</div>
            <div class="kolom">Kolom 15</div>
            <div class="kolom">Kolom 16</div>
            <div class="kolom">Kolom 17</div>
        </div>
        <br>
        <td colspan="2">Keterangan warna <span class="small-box1"></span></td>
        <td colspan="2">Keterangan warna <span class="small-box2"></span></td>
        <td colspan="2">Keterangan warna <span class="small-box3"></span></td>
        <td colspan="2">Keterangan warna <span class="small-box4"></span></td>
        <br>
        <marquee class="teks-berjalan" behavior="scroll" direction="left" onmouseover="this.stop();" onmouseout="this.start();" style="font-size: larger;">
            UTAMAKAN KESELAMATAN KERJA, TINGKATKAN PRODUKTIFITAS, KURANGI MASALAH, KURANGI LOSS WAKTU DAN JAGA 5R DI LINGKUNGAN KERJA :: UTAMAKAN KESEHATAN DAN KESELAMATAN KERJA, SELALU MENGGUNAKAN ALAT PELINDUNG DIRI, JAGA 5R, DAN SELALU WASPADA TERHADAP PENYEBARAN COVID-19
        </marquee>
    </div>


</body>
<script>
    // function randomColor() {
    //     var letters = '0123456789ABCDEF';
    //     var color = '#';
    //     for (var i = 0; i < 6; i++) {
    //         color += letters[Math.floor(Math.random() * 16)];
    //     }
    //     return color;
    // }

    // var koloms = document.querySelectorAll('.kolom');
    // koloms.forEach(function(kolom) {
    //     kolom.style.backgroundColor = randomColor();
    // });
</script>

</html>