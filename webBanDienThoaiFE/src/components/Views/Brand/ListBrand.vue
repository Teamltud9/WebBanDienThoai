<template>
  <section class="brands">
    <div class="contai">
      <swiper :modules="modules" :slides-per-view="10" :space-between="20" :loop="true"
        :autoplay="{ delay: 3000, disableOnInteraction: false }" class="swiper-contai">
        <swiper-slide v-for="brand in brands" :key="brand.id" class="brand-item">
          <img :src="`http://127.0.0.1:8000${brand.logo}`" :alt="`http://127.0.0.1:8000${brand.logo}`">
          <h3>{{ brand.brandName }}</h3>
        </swiper-slide>
      </swiper>
    </div>
  </section>
</template>

<script>
import { Swiper, SwiperSlide } from "swiper/vue";
import "swiper/css";
import "swiper/css/navigation";
import "swiper/css/autoplay";
import { Navigation, Autoplay } from "swiper/modules";
import BrandVM from '@/models/Enities/BrandVM'
import BrandService from '@/services/BandService';
import { IMAGE_BASE_URL } from '@/services/axiosInstance';
export default {
  components: {
    Swiper,
    SwiperSlide,
  },
  data() {
    return {
      // brands: [
      //   { id: 1, name: "Brand 1", logo: "../../../assets/images/dienthoai.png" },
      //   { id: 2, name: "Brand 2", logo: "../../../assets/images/dienthoai.png" },
      //   { id: 3, name: "Brand 3", logo: "../../../assets/images/dienthoai.png" },
      //   { id: 4, name: "Brand 4", logo: "../../../assets/images/dienthoai.png" },
      //   { id: 5, name: "Brand 5", logo: "../../../assets/images/dienthoai.png" },
      //   { id: 6, name: "Brand 6", logo: "../../../assets/images/dienthoai.png" },
      //   { id: 7, name: "Brand 7", logo: "../../../assets/images/dienthoai.png" },
      //   { id: 2, name: "Brand 8", logo: "../../../assets/images/dienthoai.png" },
      //   { id: 3, name: "Brand 9", logo: "../../../assets/images/dienthoai.png" },
      //   { id: 4, name: "Brand 10", logo: "../../../assets/images/dienthoai.png" },
      //   { id: 5, name: "Brand 11", logo: "../../../assets/images/dienthoai.png" },
      //   { id: 6, name: "Brand 12", logo: "../../../assets/images/dienthoai.png" },
      //   { id: 7, name: "Brand 13", logo: "../../../assets/images/dienthoai.png" },
      //   { id: 2, name: "Brand 14", logo: "../../../assets/images/dienthoai.png" },
      //   { id: 3, name: "Brand 15", logo: "../../../assets/images/dienthoai.png" },
      //   { id: 4, name: "Brand 16", logo: "../../../assets/images/dienthoai.png" },
      //   { id: 5, name: "Brand 17", logo: "../../../assets/images/dienthoai.png" },
      //   { id: 6, name: "Brand 18", logo: "../../../assets/images/dienthoai.png" },
      //   { id: 7, name: "Brand 19", logo: "../../../assets/images/dienthoai.png" },
      // ],
      brands: [new BrandVM()],
      modules: [Navigation, Autoplay],
    };
  },

  methods: {
    imageUrl(path) {
      console.log("brand: ", path);
      return `${IMAGE_BASE_URL}/${path}`;
    },
    async GetAllBrands() {
      const res = await BrandService.GetAllBrands();
      console.log("brand:",res.result);
      this.brands = res.result;
    }
  },
  async created() {
    await this.GetAllBrands();
  },

};
</script>

<style scoped>
.brands {
  background-color: #f5f5f5;
  padding: 20px 0;
  display: flex;
  justify-content: center;
  align-items: center;
}

.contai {
  width: 80%;
}

.swiper-contai {
  width: 100%;
}

.brand-item {
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
  padding: 10px;
  background-color: #fff;
  border-radius: 5px;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
}

.brand-item img {
  width: 100px;
  height: 100px;
  object-fit: contain;
  margin-bottom: 10px;
}
</style>