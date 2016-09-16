function Files(){
}

Files.list = [];

/**
 * @returns {Array}
 */
Files.get = function(){
    return Files.list;
};

/**
 * @return {FileReader}
 */
Files.add = function(file, index, onloadend){
    var reader = new FileReader();
    if(!file){
        return reader;
    }

    reader.onloadend = (function(){
        return function(e){
            Files.list.push(file);
            if(onloadend){
                onloadend(e.target, file, index);
            }
        }
    })(file, index);

    reader.readAsDataURL(file);

    return reader;
};

Files.addList = function(list, onloadend){
    $.each(list, function(index, file){
        Files.add(file, index + 1, onloadend);
    });
};