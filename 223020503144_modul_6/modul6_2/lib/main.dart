import 'package:flutter/material.dart';

void main() {
  runApp(MyApp());
}

class MyApp extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      home: MyHomePage(), // Mengatur MyHomePage sebagai home aplikasi
    );
  }
}

class MyHomePage extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('ListViewBuilder Example'),
      ),
      body: Center(
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            ElevatedButton(
              onPressed: () {
                // Navigasi ke halaman berikutnya saat tombol "Mulai" ditekan
                Navigator.push(
                  context,
                  MaterialPageRoute(
                    builder: (context) => MyListViewPage(), // Halaman selanjutnya adalah MyListViewPage
                  ),
                );
              },
              child: Text('Mulai'),
            ),
          ],
        ),
      ),
    );
  }
}

class ListItem {
  final String title;
  final String jurusan;
  final String tempatLahir;
  final String alamat;
  final String noTelp;

  ListItem({
    required this.title,
    required this.jurusan,
    required this.tempatLahir,
    required this.alamat,
    required this.noTelp,
  });
}

class MyListViewPage extends StatelessWidget {
  final List<ListItem> items = [
    ListItem(
      title: 'Oktafiani Luju',
      jurusan: 'Teknik Informatika',
      tempatLahir: 'Welong',
      alamat: 'Jl. Rajawali II',
      noTelp: '08123456789',
    ),
    ListItem(
      title: 'Deska P. Hutagalung',
      jurusan: 'Teknik Informatika',
      tempatLahir: 'Palangka Raya',
      alamat: 'Jl. G. Obos VI',
      noTelp: '08234567890',
    ),
    ListItem(
      title: 'Jugram Haschwalth',
      jurusan: 'Teknik Kimia',
      tempatLahir: 'Bandung',
      alamat: 'Jl. Merpati No. 789',
      noTelp: '083456789014',
    ),
    ListItem(
      title: 'NaNaNa Najahkoop',
      jurusan: 'Teknik Sipil',
      tempatLahir: 'Papua Pegunungan',
      alamat: 'Jl. Kucing No. 789',
      noTelp: '08345678901',
    ),
    ListItem(
      title: 'Meninas McAllon',
      jurusan: 'Matematika Murni',
      tempatLahir: 'Surabaya',
      alamat: 'Jl. Siam No. 789',
      noTelp: '08345678901',
    ),
    // Daftar lainnya...
  ];

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('ListViewBuilder Example'),
        actions: [
          IconButton(
            icon: Icon(Icons.play_arrow),
            onPressed: () {
              // Logika untuk aksi ketika tombol "mulai" ditekan
              // Misalnya: memulai sesuatu atau menampilkan pesan
              print('Tombol "mulai" ditekan');
            },
          ),
        ],
      ),
      body: MyListView(
        items: items,
      ),
    );
  }
}

class MyListView extends StatelessWidget {
  final List<ListItem> items; // Variabel untuk menampung item-item
  MyListView({required this.items}); // Constructor

  @override
  Widget build(BuildContext context) {
    return ListView.builder(
      itemCount: items.length,
      itemBuilder: (context, index) {
        String firstLetter =
            items[index].title.isEmpty ? '' : items[index].title[0];
        String secondLetter =
            items[index].title.length > 1 ? items[index].title[1] : '';

        return ListTile(
          title: Text(items[index].title), // Mengatur judul konten
          subtitle: Text(
              items[index].jurusan), // Mengatur jurusan konten sebagai subtitle
          leading: CircleAvatar(
            child: Text(
              (firstLetter + secondLetter).toUpperCase(),
              style: TextStyle(color: Colors.white),
            ),
            backgroundColor: Colors.blue,
          ),
          trailing: Icon(Icons.arrow_forward), // Icon di sebelah kanan
          onTap: () {
            // Tambahkan logika navigasi ke halaman baru
            Navigator.push(
              context,
              MaterialPageRoute(
                builder: (context) => DetailPage(item: items[index]),
              ),
            );
          },
        );
      },
    );
  }
}

class DetailPage extends StatelessWidget {
  final ListItem item;

  const DetailPage({Key? key, required this.item}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text(item.title),
      ),
      body: Center(
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            Text(
              'Detail ${item.title}',
              style: TextStyle(fontSize: 24),
            ),
            SizedBox(height: 20),
            Text(
              'Jurusan: ${item.jurusan}',
              style: TextStyle(fontSize: 20),
            ),
            Text(
              'Tempat Lahir: ${item.tempatLahir}',
              style: TextStyle(fontSize: 20),
            ),
            Text(
              'Alamat: ${item.alamat}',
              style: TextStyle(fontSize: 20),
            ),
            Text(
              'No. Telp: ${item.noTelp}',
              style: TextStyle(fontSize: 20),
            ),
          ],
        ),
      ),
    );
  }
}
