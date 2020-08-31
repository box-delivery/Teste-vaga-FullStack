import Cookies from "@/utils/Cookies";
const File = {
  header() {
    const token = Cookies.read("token");

    const headers = {
      'Content-Type': 'multipart/form-data',
      Authorization: `Bearer` + token,
    };

    return headers;
  },
};

export default File;

