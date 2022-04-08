const fileSelect = {
    // データ定義
    data() {
        return {
            counter: 1,
            //ファイル自体のデータ
            file: [null, null, null, null],
            // 画面上のDOM要素
            ref: [null, null, null, null]
        }
    },
    // DOMが読み込まれた直後
    mounted: function() {
        this.ref[0] = this.$refs.prev0;
        this.ref[1] = this.$refs.prev1;
        this.ref[2] = this.$refs.prev2;
        this.ref[3] = this.$refs.prev3;
    },
    // 関数
    methods: {
        // ファイルアップロード
        uploadFile(n) {
            // 先に存在していれば画像要素を削除する

            // 読み込まれるファイルの情報を取得
            const file = this.ref[n].files[0];
            // 読み込んだファイルをHTMLの要素にセットする
            this.file[n] = URL.createObjectURL(file);
        },
        // ファイル削除
        deleteFile(n) {
            // ファイルを削除する
            this.file[n] = null;
            this.ref[n].value = "";
        },
        deleteFileAlready(n) {
            let target = document.getElementById("pics" + n + "_");
            target.remove();
            target = document.getElementById("pics" + n + "_b");
            target.remove();
        }
    }
}
Vue.createApp(fileSelect).mount('#app');